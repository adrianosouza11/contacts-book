<template>
    <AppLayout>
        <ContactForm :initialValues="contact" v-if="contact"/>
    </AppLayout>  
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue';
import ContactForm from '@/components/contact/Form.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { useContactListStore } from '@/stores/contactListStore';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const store = useContactListStore();

const id: number = Number(route.params.id);

const contact = computed(() => store.getContactById(id))

onMounted( async () => {
    if (!store.data.length){
        await store.loadContacts();
    }

    if (!contact.value){
        router.push({ name: 'NotFoundPage' });
    }
});


</script>