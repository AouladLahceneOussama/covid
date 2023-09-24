<div class="w-full flex flex-col items-center justify-center bg-gray-100" id="cityMenu">

    <div class="w-4/5 mx-auto mt-4 flex justify-between">
        <h1 class="font-bold text-xl">Cases by counties and regions </h1>
        <p class="text-gray-500 text-xs"><?php echo $m->Lastdate() ?></p>
    </div>
    
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
        <?php $m->allRegionCity() ?>
    </div>
</div>