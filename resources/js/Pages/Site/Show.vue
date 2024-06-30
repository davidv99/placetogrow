<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FileInput from "@/Components/FileInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from 'vue';

const page = usePage()

const site = ref(page.props.site);

const initialValues = {
    name: site.value.name,
    document: site.value.document,
    avatar:null,
    privacity: site.value.private,
}
const form = useForm(initialValues)

const onSelectAvatar = (e) => {

    const files = e.target.files;
    if(files.length){
        form.avatar = files[0]
    }
    console.log(form.avatar)
}

const submit = () => {
    form.post(route('site.update', site.value),{
        onSuccess: (e) => {
            site.value = e.props.site;
        }
    })
}

</script>

<template>
    <Head title="Update Sites" />

    <AuthenticatedLayout>
        <template #header>
            <div class= "flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update Sites</h2>
                <Link :href="route('site.index')">
                    List sites
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="w-1/3 py-5 space-y-3" @submit.prevent="submit">
                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-if="form.recentlySuccessful" class="text-sm text-green-600 text-center">Site updated</p>
                        </Transition>
                        <div class="mt-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" placeholder="Name"/>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="document" value="document" />
                            <TextInput id="document" type="text" class="mt-1 block w-full" v-model="form.document" placeholder="+57 XXXX"/>
                            <InputError class="mt-2" :message="form.errors.document" />
                        </div>
                        <div>
                            <img class="h-16" :src="`/storage/${site.avatar}`" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="avatar" value="Avatar" />
                            <FileInput name="avatar" @change="onSelectAvatar"/>
                            <InputError class="mt-2" :message="form.errors.avatar" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="privacity" value="Privacity" />
                            <select v-model="form.privacity" name="privacity" id="privacity"
                                    class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.privacity" />
                        </div>
                        <div class="flex justify-center">
                            <PrimaryButton>
                                Update Site
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
