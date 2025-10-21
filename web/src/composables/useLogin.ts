import { useLoggedUserStore } from '@/stores/loggedUser';
import { computed } from 'vue';
import { fetchAuthMe } from '@/services/auth/loginService';
import { useLoading } from '@/composables/useLoading';

interface LoggedUserState {
  name: string
  documentNumber: string
  isCompany: boolean
  showNameUser: string
  email: string
}

export function useLogin() {
  const loggedUserStore = useLoggedUserStore();

  const {  loadingStart, loadingStop  } = useLoading();

  const loggedUser = computed( () => loggedUserStore.loggedUser )

  async function fetchLoggedUser() {
    loadingStart();

    const res = (await fetchAuthMe()).data

    setLoggedUserMe({
      name: res.data.company.companyName,
      showNameUser: res.data.company.owner.name,
      isCompany: true,
      documentNumber: res.data.company.cnpj,
      email: res.data.company.owner.email
    });

    loadingStop();
  }

  function setLoggedUserMe(payload: LoggedUserState) {
    return loggedUserStore.setLoggedUser(payload);
  }

  return {
    loggedUser,
    setLoggedUserMe,
    fetchLoggedUser
  }
}