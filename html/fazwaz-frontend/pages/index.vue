<template>
    <main>
        <div class="grid h-screen grid-cols-12 p-20 gap-x-10">
            <div class="h-full col-span-4 p-10 overflow-auto text-white shadow-md bg-sky-500 rounded-xl">
                <PropertyFilter />
            </div>
            <div class="col-span-8 p-10 overflow-auto text-white shadow-md bg-sky-500 rounded-xl">
                <PropertyResult />
            </div>
        </div>
    </main>
</template>

<script>
export default {};
</script>
