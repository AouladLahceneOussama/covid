<div class="w-full flex flex-col items-center justify-center" id="home">
    <div class="w-full flex flex-col md:flex-row items-center justify-center space-x-6 mb-8">

        <div class="relative bg-white py-6 px-6 w-64 my-4">
            <img src="/assets/banner_virus.svg" alt="virus-banner">
        </div>

        <!-- 1 card -->
        <div class="relative bg-white py-6 px-6 rounded-3xl my-4 shadow-xl w-4/5 md:w-3/5 ">
            <div class=" text-white w-14 h-14 flex items-center justify-center flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-indigo-300 left-4 -top-6 text-xl">
                <i class="fas fa-syringe"></i>
            </div>

            <div class="mt-8">
                <p class="text-2xl font-semibold my-2">Vaccination</p>
                <div class="flex justify-between items-center text-sm">

                    <p class="text-lg text-gray-400">First dose</p>
                    <p class="text-2xl font-semibold"><?php echo $data['dose_1'] ?></p>
                </div>
                <div class="flex justify-between text-sm my-1">
                    <p class="text-lg text-gray-400">Second dose</p>
                    <p class="text-2xl font-semibold"><?php echo $data['dose_2'] ?></p>
                </div>
                <div class="border-t-2"></div>

                <div class="flex justify-between">

                    <div class="my-2 flex justify-between w-full">
                        <p class="font-semibold text-base mb-2">Progress Of Vaccination</p>
                        <div class="text-base text-gray-400 font-semibold">
                            <p><?php echo round($data['dose_2'] / 37333264 * 100, 2) . "%" ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
        <!-- 1 card -->
        <div class="relative bg-white py-6 px-6 rounded-3xl w-72 my-4 shadow-xl">
            <div class=" text-white text-2xl w-14 h-14 flex items-center justify-center flex items-center absolute rounded-full p-4 shadow-xl bg-green-400 left-4 -top-6">
                <i class="fas fa-grin-alt"></i>
            </div>

            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Recovered</p>
                <div class="text-2xl mt-8 px-2">
                    <div class="flex justify-between">
                        <p class="uppercase text-xs text-gray-500">today</p>
                        <p class="text-xl"><?php echo $data['recovered'] ?></p>
                    </div>

                    <div class="flex justify-between mb-2">
                        <p class="uppercase text-xs text-gray-500">total</p>
                        <p class="text-xl"><?php echo $data['recovered_total'] ?></p>
                    </div>

                    <div class="border-t-2"></div>
                </div>

            </div>
        </div>

        <!-- 2 card -->
        <div class="relative bg-white py-6 px-6 rounded-3xl w-72 my-4 shadow-xl">
            <div class=" text-white text-2xl w-14 h-14 flex items-center justify-center flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-blue-400 left-4 -top-6">
                <i class="fas fa-check"></i>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Confirmed cases</p>
                <div class="text-2xl mt-8 px-2">
                    <div class="flex justify-between">
                        <p class="uppercase text-xs text-gray-500">today</p>
                        <p class="text-xl"><?php echo $data['confirmed_cases'] ?></p>
                    </div>

                    <div class="flex justify-between mb-2">
                        <p class="uppercase text-xs text-gray-500">total</p>
                        <p class="text-xl"><?php echo $data['confirmed_cases_total'] ?></p>
                    </div>

                    <div class="border-t-2"></div>
                </div>

            </div>
        </div>

        <!-- 3 card -->
        <div class="relative bg-white py-6 px-6 rounded-3xl w-72 my-4 shadow-xl">
            <div class=" text-white text-2xl w-14 h-14 flex items-center justify-center absolute rounded-full py-4 px-4 shadow-xl bg-yellow-500 left-4 -top-6">
                <i class="fas fa-procedures"></i>
            </div>

            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Actif Cases</p>
                <div class="text-2xl mt-8 px-2">
                    <div class="flex justify-between">
                        <p class="uppercase text-xs text-gray-500">today</p>
                        <p class="text-xl"><?php echo $data['active_cases'] ?></p>
                    </div>

                    <div class="flex justify-between mb-2">
                        <p class="uppercase text-xs text-gray-500">Critical </p>
                        <p class="text-xl"><?php echo $data['critical_cases'] ?></p>
                    </div>

                    <div class="border-t-2"></div>
                </div>

            </div>
        </div>

        <!-- 4 card -->
        <div class="relative bg-white py-6 px-6 rounded-3xl w-72 my-4 shadow-xl">
            <div class=" text-white text-2xl w-14 h-14 flex items-center justify-center flex items-center absolute rounded-full py-4 px-4 shadow-xl bg-red-400 left-4 -top-6">
                <i class="fas fa-skull-crossbones"></i>
            </div>
            <div class="mt-8">
                <p class="text-xl font-semibold my-2">Deaths</p>
                <div class="text-2xl mt-8 px-2">
                    <div class="flex justify-between">
                        <p class="uppercase text-xs text-gray-500">today</p>
                        <p class="text-xl"><?php echo $data['death'] ?></p>
                    </div>

                    <div class="flex justify-between mb-2">
                        <p class="uppercase text-xs text-gray-500">total</p>
                        <p class="text-xl"><?php echo $data['death_total'] ?></p>
                    </div>

                    <div class="border-t-2"></div>
                </div>

            </div>
        </div>
    </div>
</div>