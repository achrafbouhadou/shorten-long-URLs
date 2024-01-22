<script setup>
import { onMounted , ref } from 'vue';

const emit = defineEmits(['update:isVisibleRead'])
const props = defineProps({
    url: Object,
    isVisibleRead:Boolean,
   
   
})
onMounted(() => {
    console.log(props.url)
})
const closeModal = ()=> {
emit('update:isVisibleRead' , false)
}
const isCopied = ref(false);
const copyTextToClipboard = () => {
    const textToCopy = document.getElementById('shortenURL').textContent;
    const textArea = document.createElement('textarea');
    textArea.value = textToCopy;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand('copy');
    document.body.removeChild(textArea);
    isCopied.value = true
};
</script>
<template>

<div v-if="isVisibleRead"  class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <div class="flex justify-center items-center">
                            <h3 class="font-semibold " id="shortenURL">
                                http://localhost:8000/api/shorturl/{{ url.short_code }}
                                    
                        </h3>
                            <svg
                                class="w-4 h-4 ml-3 text-gray-800 dark:text-white cursor-pointer"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 18 20"
                                @click="copyTextToClipboard()"
                            >
                                <!-- Check the value of isCopied and render different SVG paths accordingly -->
                                <template v-if="isCopied">
                                    <!-- SVG path for copied state -->
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                </template>
                                <template v-else>
                                    <!-- SVG path for not copied state -->
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.708 2.292.706-.706A2 2 0 0 1 9.828 1h6.239A.97.97 0 0 1 17 2v12a.97.97 0 0 1-.933 1H15M6 5v4a1 1 0 0 1-1 1H1m11-4v12a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 5h5.239A.97.97 0 0 1 12 6Z"/>
                                </template>
                      </svg>


                        </div>
                       
                        <p class="font-bold">
                         clicks :   {{ url.clicks }}
                        </p>
                    </div>
                    <div>
                        <button @click="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="readProductModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"> {{ url.description }}</dd>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">full url</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ url.long_url }}</dd>
                </dl>
                
        </div>
    </div>
</div>
    
</template>
    
<style scoped></style>