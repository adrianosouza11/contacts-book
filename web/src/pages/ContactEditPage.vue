<template>
    <AppLayout>
        <ContactForm :initialValues="contact" v-if="contact"/>
    </AppLayout>  
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import ContactForm from '@/components/contact/Form.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useRoute, useRouter } from 'vue-router';
import { useTableData } from '@/composables/useTableData';
import type { ContactType } from '@/services/contactService';

const route = useRoute();
const router = useRouter();

const { findContactById } = useTableData();

const id: number = Number(route.params.id);

let contact = ref<ContactType|null>(null);

onMounted( async () => {
    contact.value = await findContactById(id)

    if (!contact.value){
        router.push({ name: 'NotFoundPage' });
    }
});


</script>