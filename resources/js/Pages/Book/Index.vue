<script lang="ts">
import BaseLayout from '@/Layouts/BaseLayout.vue';

export default {
    layout: BaseLayout,
}
</script>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { FilterMatchMode } from 'primevue/api';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

import { Inertia } from "@inertiajs/inertia";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    books: {
        type: Array,
    }
});
const filters = ref({
            'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
        });

const createClick = () => {
    Inertia.get(route("book.create"));
};
const editClick = (data:Array) => {
    // console.log('masu',data);
    // alert(data.id);
    Inertia.get(route("book.edit",data));
};
const deleteClick = (data:Array) => {
    // alert(data.id);
    Inertia.delete(route("book.destroy",data.id));
};
</script>

<template>
    <div>
        <div class="card">

            <DataTable :value="books.data" 
                :paginator="true" :rows="10" :filters="filters"
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[5,10,25]"
                currentPageReportTemplate="Showing {first} to {last} of {totalRecords} books" responsiveLayout="scroll">
                <template #header>
                    <div class="flex flex-column md:flex-row md:justify-content-between md:align-items-center">
                        <div class="flex flex-nowrap align-items-center">
                            <h5 class="mr-5">検索</h5>
                            <span class="p-input-icon-left">
                                <i class="pi pi-search" />
                                <InputText v-model="filters['global'].value" placeholder="Search..." />
                            </span>
                        </div>
                        <Button label="New" icon="pi pi-plus" class="p-button-success mr-2" @click="createClick" />
                    </div>
                </template>
                <Column field="name" header="作名" :sortable="true" style="min-width:16rem"></Column>
                <Column field="author" header="作者名" :sortable="true" style="min-width:16rem"></Column>
                <Column field="price" header="価格" :sortable="true" style="min-width:16rem"></Column>
                <Column :exportable="false" style="min-width:8rem">
                    <template #body="slotProps">
                        <Button icon="pi pi-pencil" class="p-button-rounded p-button-success mr-2" @click="editClick(slotProps.data)" />
                        <Button icon="pi pi-trash" class="p-button-rounded p-button-warning" @click="deleteClick(slotProps.data)" />
                    </template>
                </Column>
            </DataTable>
            
        </div>


    </div>
</template>

<style scoped>
.table-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    @media screen and (max-width: 960px) {
        align-items: start;
	}
}

.product-image {
    width: 50px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.p-dialog .product-image {
    width: 50px;
    margin: 0 auto 2rem auto;
    display: block;
}

.confirmation-content {
    display: flex;
    align-items: center;
    justify-content: center;
}
/* 
@media screen and (max-width: 960px) {
	::v-deep(.p-toolbar) {
		flex-wrap: wrap;
		.p-button {
            margin-bottom: 0.25rem;
        }
	}
}
 */
</style>

