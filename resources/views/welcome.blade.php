<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoWulkanizacja Janek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 to-indigo-600 min-h-screen flex items-center justify-center p-4">

<div class="bg-white shadow-2xl rounded-2xl w-full max-w-2xl overflow-hidden">
    <!-- Górna sekcja: logo i nazwa -->
    <div class="bg-gray-100 p-6 flex flex-col items-center">
        <img src="https://via.placeholder.com/120" alt="Logo Wulkanizacji" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full mb-4 border-4 border-blue-500">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center">Autodwulkanizacjacja Janek</h1>
        <p class="text-gray-600 mt-2 text-center px-4 sm:px-0">Profesjonalna wymiana opon i serwis kół we Wrocławiu. Szybko, tanio i solidnie.</p>
    </div>

    <!-- Kontakt -->
    <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
        <div class="flex flex-col items-center">
            <i class="fas fa-phone-alt text-blue-500 text-2xl mb-2"></i>
            <a href="tel:123456789" class="text-gray-700 font-semibold hover:text-blue-600 transition">123-456-789</a>
        </div>
        <div class="flex flex-col items-center">
            <i class="fas fa-envelope text-green-500 text-2xl mb-2"></i>
            <a href="mailto:kontakt@autowulkanizacja.pl" class="text-gray-700 font-semibold hover:text-green-600 transition">kontakt@autowulkanizacja.pl</a>
        </div>
        <div class="flex flex-col items-center">
            <i class="fas fa-map-marker-alt text-red-500 text-2xl mb-2"></i>
            <p class="text-gray-700 font-semibold">ul. Kościuszki 12, Wrocław</p>
        </div>
    </div>

    <!-- Godziny otwarcia -->
    <div class="bg-gray-50 p-6 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Pn</p>
            <p>8:00 - 18:00</p>
        </div>
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Wt</p>
            <p>8:00 - 18:00</p>
        </div>
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Śr</p>
            <p>8:00 - 18:00</p>
        </div>
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Cz</p>
            <p>8:00 - 18:00</p>
        </div>
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Pt</p>
            <p>8:00 - 18:00</p>
        </div>
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Sb</p>
            <p>9:00 - 14:00</p>
        </div>
        <div class="p-2 rounded-lg bg-white shadow hover:shadow-lg transition">
            <p class="font-bold">Nd</p>
            <p>Zamknięte</p>
        </div>
    </div>

    <!-- Mapka -->
    <div class="p-6">
        <iframe class="w-full h-56 sm:h-64 rounded-lg shadow-lg"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2449.123456789!2d17.033333!3d51.100000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x0!2zNTXCsDA2JzUwLjIiTiAxN8KwMDEnMDkuNiJF!5e0!3m2!1spl!2spl!4v1700000000000"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Logowanie / Rejestracja -->
    <div class="p-6 flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/admin/login"
           class="w-full sm:w-auto bg-indigo-600 text-white px-6 py-3 rounded-full font-semibold text-center hover:bg-indigo-700 transition transform hover:scale-105">
            Zaloguj się
        </a>

        <a href="/admin/register"
           class="w-full sm:w-auto bg-green-600 text-white px-6 py-3 rounded-full font-semibold text-center hover:bg-green-700 transition transform hover:scale-105">
            Zarejestruj się
        </a>
    </div>

    <!-- CTA -->
    <div class="p-6 text-center">
        <a href="tel:123456789" class="block sm:inline-block w-full sm:w-auto bg-blue-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-600 transition-transform transform hover:scale-105">
            Umów się na wizytę
        </a>
    </div>
</div>

</body>
</html>
