<template>
    <div class="flex flex-col space-y-10">
        <h1 class="text-4xl font-bold">Results</h1>
        <div class="grid grid-cols-4">
            <div v-for="property in properties" :key="property.id" class="col-span-1">
                <PropertyCard :title="property.title" :price="property.price" />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            properties: [],
        };
    },
};
</script>
