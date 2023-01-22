<template>
    <div class="flex flex-col h-full space-y-2 duration-200 transform bg-white shadow-md rounded-xl hover:scale-105">
        <div class="relative flex">
            <img class="object-cover w-full h-40 rounded-t-xl" :src="image" alt="property" />
            <div class="absolute bottom-0 right-0 mb-2 mr-2">
                <div v-if="sold" class="px-4 py-1 text-white bg-red-500 rounded">Sold</div>
                <div v-else class="px-4 py-1 text-white bg-green-500 rounded">Sale</div>
            </div>
        </div>
        <div class="p-4">
            <h4 class="font-semibold text-gray-600 truncate">{{ title }}</h4>
            <p class="text-gray-600 truncate">Province: {{ province }}</p>
            <p class="text-gray-600 truncate">Price: {{ price }} THB</p>
            <p class="text-gray-600 line-clamp-2">Street: {{ street }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        image: {
            type: String,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        price: {
            type: Number,
            required: true,
        },
        sold: {
            type: Boolean,
            required: true,
        },
        province: {
            type: String,
            required: true,
        },
        street: {
            type: String,
            required: true,
        },
    },
};
</script>
