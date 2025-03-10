<template>
  <div class="relative w-full max-w-md">
    <div
      class="bg-gray-800 p-4 rounded-md shadow-md flex items-center gap-3 border border-gray-600 transition-all focus-within:ring-2 focus-within:ring-blue-500"
    >
      <Icon 
        name="lucide:map-pin" 
        class="w-6 h-6 text-blue-400 ml-2 transition-transform duration-300 ease-in-out hover:scale-110" 
      />
      <input
        v-model="city"
        placeholder="Digite o nome da cidade..."
        @focus="showHistory = true"
        @blur="hideHistory"
        class="flex-1 p-2 text-lg text-white bg-transparent border-none focus:outline-none"
      />
      <button
        @click="searchCity"
        class="p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all flex items-center justify-center transform hover:scale-105 active:scale-95"
      >
        <Icon 
          name="lucide:search" 
          class="w-6 h-6 transition-transform duration-300 ease-in-out hover:rotate-180" 
        />
      </button>
    </div>

    <ul 
      v-if="showHistory && searchHistory.length" 
      class="absolute top-full mt-2 bg-gray-700 text-white rounded-md shadow-md w-full overflow-hidden"
    >
      <li 
        v-for="(historyItem, index) in searchHistory" 
        :key="index" 
        @click="selectHistoryItem(historyItem)"
        class="p-3 cursor-pointer hover:bg-gray-600 transition-all"
      >
        {{ historyItem }}
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const city = ref("");
const showHistory = ref(false);
const searchHistory = ref([]);
const emit = defineEmits(["search"]);

onMounted(() => {
  if (typeof window !== "undefined") {
    searchHistory.value = JSON.parse(localStorage.getItem("searchHistory") || "[]");
  }
});

const searchCity = () => {
  if (!city.value.trim()) {
    window.location.reload();
    return;
  }

  if (!searchHistory.value.includes(city.value.trim())) {
    searchHistory.value.unshift(city.value.trim());
    if (searchHistory.value.length > 5) searchHistory.value.pop();
    localStorage.setItem("searchHistory", JSON.stringify(searchHistory.value));
  }

  emit("search", city.value.trim());
  showHistory.value = false;
};

const selectHistoryItem = (item) => {
  city.value = item;
  searchCity();
};

const hideHistory = () => {
  setTimeout(() => {
    showHistory.value = false;
  }, 200);
};
</script>
