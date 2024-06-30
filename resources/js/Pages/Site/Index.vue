<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, usePage} from '@inertiajs/vue3';
import {ref} from 'vue';

const page = usePage()
const sites = ref(page.props.sites);
const onDeleteSuccess = (e) => {
    console.log(e)
    sites.value = e.props.sites;
}

</script>

<template>
    <Head title="Sites" />

    <AuthenticatedLayout>
        <template #header>
            <div class= "flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sites</h2>
                <Link :href="route('site.create')">
                    Create Site
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div className="relative overflow-x-auto">
                        <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Avatar
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="site in sites" className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{site.name}}
                                </th>
                                <td className="px-6 py-4">
                                    {{site.document}}
                                </td>
                                <td className="px-6 py-4">
                                    <img class="h-16" :src="`/storage/${site.logo}`"/>
                                </td>
                                <td className="px-6 py-4">
                                    <div class="space-x-4">
                                        <Link :href = "route('site.show', site)">
                                            Show
                                        </Link>
                                        <Link :href = "route('site.edit', site)">
                                            Edit
                                        </Link>
                                        <Link @success="onDeleteSuccess" :href = "route('site.destroy', site)" method="delete" as="button" >
                                            Delete
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
