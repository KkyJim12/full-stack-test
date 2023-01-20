<template>
    <div class="flex flex-col space-y-2 duration-200 transform bg-white shadow-md rounded-xl hover:scale-105">
        <img class="object-cover w-full h-40" src="https://picsum.photos/200/300" alt="property" />
        <div class="p-4">
            <h4 class="font-semibold text-gray-600">{{ title }}</h4>
            <p class="text-gray-600">Price: {{ price }} THB</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        price: {
            type: Number,
            required: true,
        },
    },
};
</script>
