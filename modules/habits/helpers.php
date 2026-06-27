<?php
/**
 * RoutineFlow — Habit Tracker: Helper Functions
 * 
 * Functions to calculate habits streak and weekly progress.
 */

/**
 * Calculate the current streak of completed habits.
 * 
 * Streak rules:
 * - If today is 'completed', count backwards starting today.
 * - If today is not logged/entered yet, but yesterday was 'completed', count backwards starting yesterday.
 * - Otherwise (today is 'missed', or today is not logged and yesterday was not completed), streak is 0.
 * 
 * @param array $completions Array of arrays containing 'completion_date' and 'status'
 * @return int Streak count
 */
function calculateStreak(array $completions): int {
    if (empty($completions)) {
        return 0;
    }

    // Index completions by date for O(1) lookups
    $completionsByDate = [];
    foreach ($completions as $c) {
        $completionsByDate[$c['completion_date']] = $c['status'];
    }

    $today = date('Y-m-d');
    $yesterday = (new DateTime())->modify('-1 day')->format('Y-m-d');

    // Determine starting date for streak verification
    if (isset($completionsByDate[$today]) && $completionsByDate[$today] === 'completed') {
        $startDate = $today;
    } elseif (
        (!isset($completionsByDate[$today]) || $completionsByDate[$today] === 'missed')
        && isset($completionsByDate[$yesterday])
        && $completionsByDate[$yesterday] === 'completed'
    ) {
        $startDate = $yesterday;
    } else {
        return 0;
    }

    $streak = 0;
    $date = new DateTime($startDate);

    // Count backwards until we hit a non-completed or missing day
    while (true) {
        $key = $date->format('Y-m-d');
        if (isset($completionsByDate[$key]) && $completionsByDate[$key] === 'completed') {
            $streak++;
            $date->modify('-1 day');
        } else {
            break;
        }
    }

    return $streak;
}

/**
 * Calculate progress percentage for a habit based on frequency.
 * 
 * @param array $completions Array of completions
 * @param string $frequency frequency ('daily', 'weekly', or 'monthly')
 * @return int Percentage progress (0 to 100)
 */
function calculateWeeklyProgress(array $completions, string $frequency): int {
    $completed = 0;
    $target = 0;
    $today = new DateTime();
    $frequency = strtolower($frequency);

    if (empty($completions)) {
        return 0;
    }

    if ($frequency === 'daily') {
        // Daily target: 7 completions in the last 7 days (including today)
        $target = 7;
        $weekAgo = (clone $today)->modify('-6 days')->setTime(0, 0, 0); // last 7 days including today
        foreach ($completions as $c) {
            $cDate = new DateTime($c['completion_date']);
            $cDate->setTime(0, 0, 0);
            if ($cDate >= $weekAgo && $cDate <= $today && $c['status'] === 'completed') {
                $completed++;
            }
        }
    } elseif ($frequency === 'weekly') {
        // Weekly target: 1 completion since Monday of this week
        $target = 1;
        $weekStart = (clone $today)->modify('monday this week')->setTime(0, 0, 0);
        foreach ($completions as $c) {
            $cDate = new DateTime($c['completion_date']);
            $cDate->setTime(0, 0, 0);
            if ($cDate >= $weekStart && $cDate <= $today && $c['status'] === 'completed') {
                $completed++;
                break;
            }
        }
    } elseif ($frequency === 'monthly') {
        // Monthly target: 1 completion since the 1st day of this month
        $target = 1;
        $monthStart = new DateTime($today->format('Y-m-01'));
        $monthStart->setTime(0, 0, 0);
        foreach ($completions as $c) {
            $cDate = new DateTime($c['completion_date']);
            $cDate->setTime(0, 0, 0);
            if ($cDate >= $monthStart && $cDate <= $today && $c['status'] === 'completed') {
                $completed++;
                break;
            }
        }
    }

    return $target > 0 ? min(100, (int)round(($completed / $target) * 100)) : 0;
}

