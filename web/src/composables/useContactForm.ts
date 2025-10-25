import { reactive, ref, computed } from "vue";
import { useLoading } from "./useLoading";
import { storeContact,updateContact } from "@/services/contactService";
import router from "@/router";
import { useNotification } from "./useNotification";
import { fetchCep } from "@/services/fetchCepService";

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

export function useContactForm(initialValues: ContactFormType) {
    const {  loadingStart, loadingStop  } = useLoading();
    const { toastSuccess, toastError } = useNotification();

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

    const formErrors = ref<Record<string, string[]>>();
    
    /**
     * @returns void
     */
    async function handleSubmit() {
        loadingStart();

        formErrors.value = {};

        const phoneNumberCleaned = formData.contact_phone.replace(/\D/g, '');
        const postalCodeCleaned = formData.postal_code.replace(/\D/g, '');
    
        if(!isEditing.value)
            await submitStore({
                ...formData,
                contact_phone: phoneNumberCleaned,
                postal_code: postalCodeCleaned
            });
        else
            await submitUpdate({
                ...formData,
                contact_phone: phoneNumberCleaned,
                postal_code: postalCodeCleaned
            });
        
        submittedData.value = { ...formData };
    }

    /**
     * @param formData 
     * @returns Promise<boolean>
     */
    async function submitStore(formData: ContactFormType ) : Promise<boolean>
    {
        loadingStart();
    
        try {
            await storeContact(formData);
            
            toastSuccess('Contato cadastrado com sucesso!');

            router.push({ name: 'ContactListPage' });

            return true;
        } catch (error: any) {
            if (error.response && error.response.status === 422) {
                formErrors.value = error.response.data.errors;
                toastError("Por favor, corrija os erros no formulário.");
            } else {
                toastError("Ocorreu um erro interno salvar o contato.");
            }

            
        } finally {
            loadingStop();
        }

        return false;
    }

    /**
     * @param formData 
     * @returns Promise<boolean>
     */
    async function submitUpdate(formData: ContactFormType ) : Promise<boolean>
    {
        loadingStart();

        try {
            await updateContact(formData);
            
            toastSuccess('Contato atualizado com sucesso!');

            router.push({ name: 'ContactListPage' });

            return true;
        } catch (error: any) {
            if (error.response && error.response.status === 422) {
                formErrors.value = error.response.data.errors;
                toastError("Por favor, corrija os erros no formulário.");
            } else {
                toastError("Ocorreu um erro interno salvar o contato.");
            }
        } finally {
            loadingStop();
        }

        return false;
    }

    const isSearchingCep = ref<boolean>(false);

    async function handleCepChange() {
        formErrors.value = {};

        if (formData.postal_code.length < 9) {
            formErrors.value = { postal_code: ['Formato de CEP inválido.'] };
            return;
        }

        loadingStart();

        isSearchingCep.value = true;

        try {
            const addressData = await fetchCep(formData.postal_code);
            
            if(addressData.data.data){
                formData.address = addressData.data.data.street || '';
                formData.neighborhood = addressData.data.data.neighborhood || '';
                formData.city = addressData.data.data.city || '';
                formData.state = addressData.data.data.state || '';
            } else {
                formErrors.value = { postal_code: ['CEP não encontrado.'] };
            }

        } catch (error: any) {
            if (error.response && error.response.status === 422) {
                formErrors.value = error.response.data.errors;
                toastError("Por favor, corrija os erros no formulário.");
            } else {
                toastError("Ocorreu um erro interno salvar o contato.");
            }
        } finally {
            loadingStop();
            isSearchingCep.value = false;
        }
    }

    return {
        formData,
        isEditing,
        handleSubmit,
        submittedData,
        handleCepChange,
        isSearchingCep,
        formErrors
    }
} 