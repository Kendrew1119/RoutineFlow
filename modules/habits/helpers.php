<?php
function calculateStreak(array $completions): int {
    if (empty($completions)) return 0;

    $streak = 0;
    $today = date('Y-m-d');
    $targetDate = (new DateTime())->modify('-1 day')->format('Y-m-d');

    $hasToday = false;
    foreach ($completions as $c) {
        if ($c['completion_date'] === $today && $c['status'] === 'completed') {
            $hasToday = true;
            break;
        }
    }

    $completionsByDate = [];
    foreach ($completions as $c) {
        $completionsByDate[$c['completion_date']] = $c['status'];
    }

    $date = new DateTime($hasToday ? $today : $targetDate);
    $todayDT = new DateTime($today);

    while ($date <= $todayDT) {
        $key = $date->format('Y-m-d');
        if (isset($completionsByDate[$key])) {
            if ($completionsByDate[$key] === 'completed') {
                $streak++;
                $date->modify('-1 day');
            } else {
                break;
            }
        } elseif ($key === $today && $hasToday) {
            $streak++;
            $date->modify('-1 day');
        } else {
            break;
        }
    }

    return $streak;
}

function calculateWeeklyProgress(array $completions, string $frequency): int {
    $completed = 0;
    $target = 0;
    $today = new DateTime();

    if ($frequency === 'daily') {
        $target = 7;
        $weekAgo = (clone $today)->modify('-7 days');
        foreach ($completions as $c) {
            $cDate = new DateTime($c['completion_date']);
            if ($cDate >= $weekAgo && $c['status'] === 'completed') {
                $completed++;
            }
        }
    } elseif ($frequency === 'weekly') {
        $target = 1;
        $weekStart = (clone $today)->modify('monday this week');
        foreach ($completions as $c) {
            $cDate = new DateTime($c['completion_date']);
            if ($cDate >= $weekStart && $c['status'] === 'completed') {
                $completed++;
                break;
            }
        }
    } elseif ($frequency === 'monthly') {
        $target = 1;
        $monthStart = new DateTime($today->format('Y-m-01'));
        foreach ($completions as $c) {
            $cDate = new DateTime($c['completion_date']);
            if ($cDate >= $monthStart && $c['status'] === 'completed') {
                $completed++;
                break;
            }
        }
    }

    return $target > 0 ? min(100, round(($completed / $target) * 100)) : 0;
}
