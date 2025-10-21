import { useToast } from 'vue-toastification';

export function useNotification() {
  const toast = useToast();

  function toastSuccess(message: string) {
    toast.success(message, { timeout: 3000 });
  }

  function toastError(message: string) {
    toast.error(message, { timeout: 5000 });
  }

  function toastInfo(message: string) {
    toast.info(message, {
      timeout: 4000,
    });
  }

  function toastWarning(message: string) {
    toast.warning(message, {
      timeout: 4000,
    });
  }

  return {
    toastSuccess,
    toastError,
    toastInfo,
    toastWarning,
  };
}