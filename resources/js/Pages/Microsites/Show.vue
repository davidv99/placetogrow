<script setup>
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    microsite: {
        type: Object,
        required: true,
    },
});

let formData = {
    // Define fields common to all site types or default fields
};

if (props.microsite.site_type === 'Facturas') {
    formData.invoice_number = '';
    formData.amount_due = '';
} else if (props.microsite.site_type === 'Donaciones') {
    formData.donor_name = '';
    formData.amount = '';
} else if (props.microsite.site_type === 'Subscripciones') {
    formData.subscription_id = '';
    formData.amount = '';
}
</script>

<template>
    <Head title="Micrositio - {{ microsite.name }}" />
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Micrositio - {{ microsite.name }}</h1>
        <form>
            <div v-if="microsite.site_type === 'Facturas'">
                <div>
                    <label for="invoice_number">Número de Factura</label>
                    <input v-model="formData.invoice_number" type="text" id="invoice_number" class="input" />
                </div>
                <div>
                    <label for="amount_due">Monto a Pagar</label>
                    <input v-model="formData.amount_due" type="text" id="amount_due" class="input" />
                </div>
            </div>
            <div v-if="microsite.site_type === 'Donaciones'">
                <div>
                    <label for="donor_name">Nombre del Donante</label>
                    <input v-model="formData.donor_name" type="text" id="donor_name" class="input" />
                </div>
                <div>
                    <label for="amount">Monto</label>
                    <input v-model="formData.amount" type="text" id="amount" class="input" />
                </div>
            </div>
            <div v-if="microsite.site_type === 'Subscripciones'">
                <div>
                    <label for="subscription_id"> Número de Suscripción</label>
                    <input v-model="formData.subscription_id" type="text" id="subscription_id" class="input" />
                </div>
                <div>
                    <label for="amount">Monto</label>
                    <input v-model="formData.amount" type="text" id="amount" class="input" />
                </div>
            </div>
            <button type="submit" class="mt-4 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-[#E6221A] transition">
                Pagar
            </button>
        </form>
    </div>
</template>

<style>
.input {
    display: block;
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>
