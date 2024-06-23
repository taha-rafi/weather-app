const API_KEY = "ee7c4b79648c7ec65f4c16b0b11a0ffe"; // Paste your API here

// Create weather card HTML based on weather data
const createWeatherCard = (cityName, weatherItem, index) => {
    if (index === 0) {
        return `<div class="mt-3 d-flex justify-content-between">
                    <div>
                        <h3 class="fw-bold">${cityName} (${formatDate(weatherItem.dt_txt.split(" ")[0])})</h3>
                        <h6 class="my-3 mt-3">Temperature: ${((weatherItem.main.temp - 273.15).toFixed(2))}°C</h6>
                        <h6 class="my-3">Wind: ${weatherItem.wind.speed} M/S</h6>
                        <h6 class="my-3">Humidity: ${weatherItem.main.humidity}%</h6>
                    </div>
                    <div class="text-center me-lg-5">
                        <img src="https://openweathermap.org/img/wn/${weatherItem.weather[0].icon}@4x.png" alt="weather icon">
                        <h6>${weatherItem.weather[0].description}</h6>
                    </div>
                </div>`;
    } else {
        return `<div class="col mb-3">
                    <div class="card border-0 bg-secondary text-white">
                        <div class="card-body p-3 text-white">
                            <h5 class="card-title fw-semibold">(${formatDate(weatherItem.dt_txt.split(" ")[0])})</h5>
                            <img src="https://openweathermap.org/img/wn/${weatherItem.weather[0].icon}.png" alt="weather icon">
                            <h6 class="card-text my-3 mt-3">Temp: ${((weatherItem.main.temp - 273.15).toFixed(2))}°C</h6>
                            <h6 class="card-text my-3">Wind: ${weatherItem.wind.speed} M/S</h6>
                            <h6 class="card-text my-3">Humidity: ${weatherItem.main.humidity}%</h6>
                        </div>
                    </div>
                </div>`;
    }
}

// Get weather details of passed latitude and longitude
const getWeatherDetails = (cityName, latitude, longitude) => {
    const WEATHER_API_URL = `https://api.openweathermap.org/data/2.5/forecast?lat=${latitude}&lon=${longitude}&appid=${API_KEY}`;

    $.getJSON(WEATHER_API_URL, (data) => {
        const forecastArray = data.list;
        const uniqueForecastDays = new Set();

        const fiveDaysForecast = forecastArray.filter(forecast => {
            const forecastDate = new Date(forecast.dt_txt).getDate();
            if (!uniqueForecastDays.has(forecastDate) && uniqueForecastDays.size < 6) {
                uniqueForecastDays.add(forecastDate);
                return true;
            }
            return false;
        });

        $("#city-input").val("");
        $(".current-weather").empty();
        $(".days-forecast").empty();

        fiveDaysForecast.forEach((weatherItem, index) => {
            const html = createWeatherCard(cityName, weatherItem, index);
            if (index === 0) {
                $(".current-weather").append(html);
            } else {
                $(".days-forecast").append(html);
            }
        });
    }).fail(() => {
        alert("An error occurred while fetching the weather forecast!");
    });
}

// Get coordinates of entered city name
const getCityCoordinates = () => {
    const cityName = $("#city-input").val().trim();
    if (cityName === "") return;
    const API_URL = `https://api.openweathermap.org/geo/1.0/direct?q=${cityName}&limit=1&appid=${API_KEY}`;

    $.getJSON(API_URL, (data) => {
        if (!data.length) return alert(`No coordinates found for ${cityName}`);
        const { lat, lon, name } = data[0];
        getWeatherDetails(name, lat, lon);
    }).fail(() => {
        alert("An error occurred while fetching the coordinates!");
    });
}

// Get weather details of current location on page load
const getCurrentLocationWeather = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const { latitude, longitude } = position.coords;
            const API_URL = `https://api.openweathermap.org/geo/1.0/reverse?lat=${latitude}&lon=${longitude}&limit=1&appid=${API_KEY}`;

            $.getJSON(API_URL, (data) => {
                if (!data.length) return alert(`No coordinates found for the current location`);
                const { name } = data[0];
                getWeatherDetails(name, latitude, longitude);
            }).fail(() => {
                alert("An error occurred while fetching the coordinates of the current location!");
            });
        }, () => {
            alert("Unable to retrieve your location.");
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

$("#search-btn").on("click", () => getCityCoordinates());

// Fetch weather for the current location on page load
$(document).ready(() => {
    getCurrentLocationWeather();
});
function formatDate(datePart) {

    // Create a new Date object from the date part
    const dateObject = new Date(datePart);

    // Format the date using Intl.DateTimeFormat
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(dateObject);

    return formattedDate;
}
