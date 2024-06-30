<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FileInput from "@/Components/FileInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from 'vue';

const form = useForm({
    name: "",
    document_type: "",
    document: "",
    logo: null,
    category_id: "",
    slug: "",
});

const onSelectLogo = (e) => {
    const files = e.target.files;
    if (files.length) {
        form.logo = files[0];
    }
    console.log(form.logo);
};

const submit = () => {
    form.post(route('site.store'));
};

const props = defineProps({
    categories: Array,
});
const categories = ref(props.categories);

console.log(categories)

</script>

<template>
    <Head title="Create Sites" />

    <AuthenticatedLayout>
        <template #header>
            <div class= "flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Sites</h2>
                <Link :href="route('site.index')">
                    List sites
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="w-1/3 py-5 space-y-3" @submit.prevent="submit">
                        <div class="mt-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" placeholder="Name"/>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="category_id" value="Category" />
                            <select v-model="form.category_id" name="category_id" id="category_id"
                                    class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.category_id" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="slug" value="Slug" />
                            <TextInput id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" autocomplete="slug" placeholder="Slug"/>
                            <InputError class="mt-2" :message="form.errors.slug" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="document_type" value="Document Type" />
                            <select v-model="form.document_type" name="document_type" id="document_type"
                                    class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="cc">CC</option>
                                <option value="ce">CE</option>
                                <option value="nit">NIT</option>
                                <option value="ppt">PPT</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.document_type" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="document" value="Document" />
                            <TextInput id="document" type="text" class="mt-1 block w-full" v-model="form.document"/>
                            <InputError class="mt-2" :message="form.errors.document" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="logo" value="Logo" />
                            <FileInput name="logo" @change="onSelectLogo"/>
                            <InputError class="mt-2" :message="form.errors.logo" />
                        </div>
                        <div class="flex justify-center">
                            <PrimaryButton>
                                Create Site
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


