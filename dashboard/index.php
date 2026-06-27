<?php
/**
 * RoutineFlow — Main Dashboard
 * [LEADER] manages this file.
 * 
 * Shows summary cards pulling stats from all 4 modules.
 * Includes weather widget and quick-action buttons.
 */

require_once '../config/session.php';
require_once '../config/db.php';
require_once '../shared/auth_check.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Dashboard';

// Query summary stats from each module table
$exerciseCount = $pdo->prepare("SELECT COUNT(*) FROM exercises WHERE user_id = ?");
$exerciseCount->execute([$user_id]);
$totalExercises = $exerciseCount->fetchColumn();

$diaryCount = $pdo->prepare("SELECT COUNT(*) FROM diary_entries WHERE user_id = ?");
$diaryCount->execute([$user_id]);
$totalEntries = $diaryCount->fetchColumn();

$moneyStmt = $pdo->prepare("SELECT 
    COALESCE(SUM(CASE WHEN transaction_type='income' THEN amount ELSE 0 END), 0) as income,
    COALESCE(SUM(CASE WHEN transaction_type='expense' THEN amount ELSE 0 END), 0) as expense
    FROM transactions WHERE user_id = ?");
$moneyStmt->execute([$user_id]);
$moneyStats = $moneyStmt->fetch();

$habitCount = $pdo->prepare("SELECT COUNT(*) FROM habits WHERE user_id = ?");
$habitCount->execute([$user_id]);
$totalHabits = $habitCount->fetchColumn();

include '../shared/header.php';
include '../shared/navbar.php';
?>

<main class="main-content">
  <div class="page-container">

    <!-- Page Header -->
    <div class="page-header">
      <div>
        <h1 class="page-title">
          <i data-lucide="layout-dashboard"></i>
          Good <?= date('H') < 12 ? 'morning' : (date('H') < 18 ? 'afternoon' : 'evening') ?>, <?= htmlspecialchars(get_username()) ?>
        </h1>
        <p class="page-subtitle">Here's your routine overview for today</p>
      </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid-4 mb-xl">
      <!-- Exercise Card -->
      <a href="../modules/exercise/index.php" class="glass-card card-dark glass-card-hover stat-card" style="text-decoration:none;">
        <div class="flex-between mb-md">
          <span class="badge badge-primary"><i data-lucide="dumbbell" style="width:14px;height:14px;"></i></span>
        </div>
        <div class="stat-value text-accent"><?= $totalExercises ?></div>
        <div class="stat-label">Workouts</div>
      </a>

      <!-- Diary Card -->
      <a href="../modules/diary/index.php" class="glass-card card-dark glass-card-hover stat-card" style="text-decoration:none;">
        <div class="flex-between mb-md">
          <span class="badge badge-success"><i data-lucide="book-heart" style="width:14px;height:14px;"></i></span>
        </div>
        <div class="stat-value text-success"><?= $totalEntries ?></div>
        <div class="stat-label">Journal Entries</div>
      </a>

      <!-- Money Card -->
      <a href="../modules/money/index.php" class="glass-card card-dark glass-card-hover stat-card" style="text-decoration:none;">
        <div class="flex-between mb-md">
          <span class="badge badge-warning"><i data-lucide="wallet" style="width:14px;height:14px;"></i></span>
        </div>
        <div class="stat-value text-warning">RM <?= number_format($moneyStats['income'] - $moneyStats['expense'], 2) ?></div>
        <div class="stat-label">Net Balance</div>
      </a>

      <!-- Habits Card -->
      <a href="../modules/habits/index.php" class="glass-card card-dark glass-card-hover stat-card" style="text-decoration:none;">
        <div class="flex-between mb-md">
          <span class="badge badge-danger"><i data-lucide="target" style="width:14px;height:14px;"></i></span>
        </div>
        <div class="stat-value text-danger"><?= $totalHabits ?></div>
        <div class="stat-label">Active Habits</div>
      </a>
    </div>

    <!-- Quick Actions + Weather Row -->
    <div class="grid-2">
      <!-- Quick Actions -->
      <div class="glass-card card-neon">
        <h2 class="text-lg font-semibold mb-lg flex items-center gap-sm">
          <span style="display:inline-flex;justify-content:center;align-items:center;background:white;color:rgba(18,18,18,0.6);border-radius:50%;width:32px;height:32px;">
            <i data-lucide="zap" style="width:16px;height:16px;"></i>
          </span>
          Quick Actions
        </h2>
        <div class="flex flex-col gap-sm">
          <a href="../modules/exercise/add.php" class="btn btn-ghost" style="justify-content:flex-start;">
            <i data-lucide="plus"></i> Log a workout
          </a>
          <a href="../modules/diary/add.php" class="btn btn-ghost" style="justify-content:flex-start;">
            <i data-lucide="plus"></i> Write journal entry
          </a>
          <a href="../modules/money/add.php" class="btn btn-ghost" style="justify-content:flex-start;">
            <i data-lucide="plus"></i> Record transaction
          </a>
          <a href="../modules/habits/add.php" class="btn btn-ghost" style="justify-content:flex-start;">
            <i data-lucide="plus"></i> Create new habit
          </a>
        </div>
      </div>

      <!-- Weather Widget (Optional) -->
      <div class="glass-card card-neon">
        <h2 class="text-lg font-semibold mb-lg flex items-center gap-sm">
          <span style="display:inline-flex;justify-content:center;align-items:center;background:white;color:rgba(18,18,18,0.6);border-radius:50%;width:32px;height:32px;">
            <i data-lucide="cloud-sun" style="width:16px;height:16px;"></i>
          </span>
          Weather
        </h2>
        <div class="text-center" style="padding: var(--space-xl) 0;">
          <div style="width: 150px; height: 150px; border: 2px dashed rgba(18, 18, 18, 0.4); border-radius: 50%; display: flex; flex-direction: column; justify-content: center; align-items: center; margin: 0 auto;">
            <div id="weather-temp" class="stat-value text-gradient" style="margin-bottom:0;">--°C</div>
            <div id="weather-desc" class="stat-label mt-sm">Loading...</div>
          </div>
          <p id="weather-city" class="font-semibold text-sm mt-md" style="margin-bottom: 2px;">Kuala Lumpur, MY</p>
          <p id="weather-location" class="text-muted text-xs">Coords: 3.14, 101.69</p>
        </div>
      </div>
    </div>

    <script>
      async function fetchWeatherForCoords(lat, lon, isFallback = false) {
        try {
          const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weather_code`);
          if (!response.ok) throw new Error('Weather API error');
          const data = await response.json();
          if (data && data.current) {
            const temp = Math.round(data.current.temperature_2m);
            const code = data.current.weather_code;
            const wmoCodes = {
              0: 'Clear sky',
              1: 'Mainly clear',
              2: 'Partly cloudy',
              3: 'Overcast',
              45: 'Fog', 48: 'Fog',
              51: 'Drizzle', 53: 'Drizzle', 55: 'Drizzle',
              61: 'Rain', 63: 'Rain', 65: 'Rain',
              71: 'Snow', 73: 'Snow', 75: 'Snow',
              77: 'Snow grains',
              80: 'Rain showers', 81: 'Rain showers', 82: 'Rain showers',
              85: 'Snow showers', 86: 'Snow showers',
              95: 'Thunderstorm', 96: 'Thunderstorm', 99: 'Thunderstorm'
            };
            document.getElementById('weather-temp').textContent = `${temp}°C`;
            document.getElementById('weather-desc').textContent = wmoCodes[code] || 'Unknown';
            document.getElementById('weather-location').textContent = `Coords: ${lat.toFixed(2)}, ${lon.toFixed(2)}`;

            if (isFallback) {
              document.getElementById('weather-city').textContent = "Kuala Lumpur, MY";
            } else {
              try {
                const geoResponse = await fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=en`);
                if (geoResponse.ok) {
                  const geoData = await geoResponse.json();
                  const city = geoData.city || geoData.locality || geoData.principalSubdivision || 'Current Location';
                  const country = geoData.countryName || '';
                  document.getElementById('weather-city').textContent = country ? `${city}, ${country}` : city;
                } else {
                  document.getElementById('weather-city').textContent = 'Current Location';
                }
              } catch (geoError) {
                console.error(geoError);
                document.getElementById('weather-city').textContent = 'Current Location';
              }
            }
          }
        } catch (error) {
          console.error(error);
          document.getElementById('weather-desc').textContent = 'Unavailable';
        }
      }

      function initWeather() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const lat = position.coords.latitude;
              const lon = position.coords.longitude;
              fetchWeatherForCoords(lat, lon, false);
            },
            (error) => {
              console.warn("Geolocation failed/denied, falling back to Kuala Lumpur.", error);
              fetchWeatherForCoords(3.1412, 101.68653, true);
            }
          );
        } else {
          fetchWeatherForCoords(3.1412, 101.68653, true);
        }
      }

      document.addEventListener('DOMContentLoaded', initWeather);
    </script>
  </div>
</main>

<?php include '../shared/footer.php'; ?>
