<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request Penghapusan Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-2xl p-8 relative overflow-hidden">

        <!-- FORM CONTAINER -->
        <div id="formContainer" class="transition-all duration-500 ease-in-out opacity-100 scale-100">

            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-red-600">Permintaan Penghapusan Akun</h1>
                <p class="text-gray-500 mt-2 text-sm">
                    Silakan isi formulir di bawah ini untuk mengajukan penghapusan akun Anda.
                </p>
            </div>

            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6 text-sm">
                ⚠️ Penghapusan akun bersifat permanen dan tidak dapat dibatalkan.
            </div>

            <form id="deleteForm" class="space-y-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email Terdaftar
                    </label>
                    <input type="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Alasan Penghapusan Akun
                    </label>
                    <textarea rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>
                </div>

                <div class="flex items-start space-x-2">
                    <input type="checkbox" required
                        class="mt-1 h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500" />
                    <label class="text-sm text-gray-600">
                        Saya memahami bahwa penghapusan akun bersifat permanen.
                    </label>
                </div>

                <div class="flex justify-end pt-4">
                    <button id="submitBtn" type="submit"
                        class="flex items-center justify-center gap-2 px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition disabled:opacity-60 disabled:cursor-not-allowed">
                        <span id="btnText">Kirim Permintaan</span>

                        <!-- Spinner -->
                        <svg id="spinner" class="hidden animate-spin h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </button>
                </div>

            </form>
        </div>

        <!-- SUCCESS STATE -->
        <div id="successContainer"
            class="absolute inset-0 flex flex-col items-center justify-center text-center px-8 opacity-0 scale-95 pointer-events-none transition-all duration-500 ease-in-out">

            <div class="bg-green-100 text-green-600 rounded-full p-4 mb-4 animate-bounce">
                ✔
            </div>

            <h2 class="text-2xl font-bold text-green-600 mb-2">
                Permintaan Berhasil Dikirim
            </h2>

            <p class="text-gray-600 mb-6">
                Permintaan penghapusan akun Anda telah kami terima.
                Tim kami akan memproses dalam 1x24 jam.
            </p>

            <button onclick="resetForm()"
                class="px-6 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                Kembali
            </button>
        </div>

    </div>

    <script>
        const form = document.getElementById('deleteForm');
        const formContainer = document.getElementById('formContainer');
        const successContainer = document.getElementById('successContainer');
        const submitBtn = document.getElementById('submitBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Aktifkan loading state
            submitBtn.disabled = true;
            spinner.classList.remove('hidden');
            btnText.textContent = "Memproses...";

            // Simulasi async API request
            setTimeout(() => {

                // Animasi keluar form
                formContainer.classList.remove('opacity-100', 'scale-100');
                formContainer.classList.add('opacity-0', 'scale-95');

                setTimeout(() => {
                    formContainer.classList.add('hidden');

                    // Tampilkan success state
                    successContainer.classList.remove('opacity-0', 'scale-95',
                        'pointer-events-none');
                    successContainer.classList.add('opacity-100', 'scale-100');

                }, 400);

            }, 1500);
        });

        function resetForm() {
            form.reset();

            successContainer.classList.remove('opacity-100', 'scale-100');
            successContainer.classList.add('opacity-0', 'scale-95', 'pointer-events-none');

            formContainer.classList.remove('hidden');
            setTimeout(() => {
                formContainer.classList.remove('opacity-0', 'scale-95');
                formContainer.classList.add('opacity-100', 'scale-100');
            }, 50);

            submitBtn.disabled = false;
            spinner.classList.add('hidden');
            btnText.textContent = "Kirim Permintaan";
        }
    </script>

</body>

</html>
