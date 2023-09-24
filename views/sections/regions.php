<div class="w-4/5 mx-auto mt-8 flex justify-between items-baseline mb-2" id="regionMenu">
    <h1 class="font-bold text-xl">Cases by regions </h1>
    <p class="text-gray-500 text-xs"><?php echo $m->Lastdate() ?></p>
</div>

<div class="mb-10 w-full flex justify-center">
    <div class="shadow overflow-hidden rounded border-b border-gray-200 w-4/5">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Regions</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-24 text-center">Cases</td>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-24 text-center">Deaths</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                <?php $m->RegionsCases(); ?>
            </tbody>
        </table>
    </div>
</div>