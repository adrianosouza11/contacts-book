import { reactive, ref, computed } from "vue";
import { useLoading } from "./useLoading";
import { storeContact } from "@/services/contactService";
import router from "@/router";
import { useNotification } from "./useNotification";

export interface ContactFormType {
    id?: number;
    contact_name: string;
    contact_phone: string;
    contact_email: string;
    address: string;
    number: string;
    neighborhood: string;
    city: string;
    state: string;
    postal_code: string;
}

const CEP_REGEX = /^\d{5}-\d{3}$/;

export function useContactForm(initialValues: ContactFormType) {
    const {  loadingStart, loadingStop  } = useLoading();
    const { toastSuccess } = useNotification();

    const isEditing = computed( () => !!initialValues.id );

    const formData = reactive<ContactFormType>({
        ...initialValues,
        contact_name: initialValues.contact_name || '',
        contact_phone: initialValues.contact_phone || '',
        contact_email: initialValues.contact_email || '',
        address: initialValues.address || '',
        number: initialValues.number || '',
        neighborhood: initialValues.neighborhood || '',
        city: initialValues.city || '',
        state: initialValues.state || '',
        postal_code: initialValues.postal_code || '',
    });

    const submittedData = ref<ContactFormType | null>(null);

    const handleSubmit = () => {
        loadingStart();

        if(isEditing.value) {
            console.log("Editing existing contact with ID:", initialValues.id);
        } else {
            submitStore(formData);
        }

        submittedData.value = { ...formData };

        loadingStop();
    }

    async function submitStore(formData: ContactFormType ) {
        loadingStart();

        try {
            await storeContact(formData);
        } catch (error) {
            console.error("Error storing contact:", error);
        } finally {
            loadingStop();
        } 

        toastSuccess('Contato cadastrado com sucesso!');

        return router.push({ name: 'ContactListPage' });
    }

    const postalCodeError = ref<string>('');
    const isSearchingCep = ref<boolean>(false);

    async function handleCepChange() {
        if(!formData.postal_code && !CEP_REGEX.test(formData.postal_code)) {
            postalCodeError.value = 'Formato de CEP inválido.';
            return;
        }
    }

    return {
        formData,
        isEditing,
        handleSubmit,
        submittedData
    }
} 