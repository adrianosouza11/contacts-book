<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
      <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
          Dados de Contato e Endereço
        </h2>

        <form class="space-y-5" @submit.prevent="handleSubmit">
          <!-- Nome -->
          <div>
            <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">
              Nome do Contato
            </label>
            <input
              type="text"
              id="contact_name"
              name="contact_name"
              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="Ex: João da Silva"
              required
              v-model="formData.contact_name"
            />
          </div>

          <!-- Telefone e E-mail -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">
                Telefone
              </label>
              <input
                type="tel"
                id="contact_phone"
                name="contact_phone"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="(11) 99999-9999"
                required
                v-model="formData.contact_phone"
                v-maska="'(##) #####-####'"
              />
            </div>

            <div>
              <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">
                E-mail
              </label>
              <input
                type="email"
                id="contact_email"
                name="contact_email"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="email@exemplo.com"
                required
                v-model="formData.contact_email"
              />
            </div>
          </div>


          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                  <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">
                    CEP
                  </label>
                  <input
                    type="text"
                    id="postal_code"
                    name="postal_code"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="00000-000"
                    v-model="formData.postal_code"
                    v-maska="'#####-###'"
                    @blur="handleCepChange"
                    :disabled="isSearchingCep"
                  />
                </div>
            </div>

        
          <div class="grid grid-cols-1">
            

            <div class="">
              <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                Endereço
              </label>
              <input
                type="text"
                id="address"
                name="address"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Rua Exemplo"
                required
                v-model="formData.address"
              />
            </div>

            
          </div>

          <!-- Bairro e Cidade -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="number" class="block text-sm font-medium text-gray-700 mb-1">
                Número
              </label>
              <input
                type="text"
                id="number"
                name="number"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="123"
                required
                v-model="formData.number"
              />
            </div>

            <div>
              <label for="neighborhood" class="block text-sm font-medium text-gray-700 mb-1">
                Bairro
              </label>
              <input
                type="text"
                id="neighborhood"
                name="neighborhood"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Centro"
                required
                v-model="formData.neighborhood"
              />
            </div>

            
          </div>

          <!-- Estado e CEP -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                Cidade
              </label>
              <input
                type="text"
                id="city"
                name="city"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="São Paulo"
                required
                v-model="formData.city"
              />
            </div>

            <div>
              <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
                Estado
              </label>
              <select name="state" id="state" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" v-model="formData.state">
                <option value="" disabled>Selecione uma opção</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
              </select>
            </div>
          </div>

          <!-- Botão -->
          <div>
            <button
              type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
            >
              {{ isEditing ? 'Atualizar Contato' : 'Criar Contato' }}
            </button>
          </div>
        </form>
      </div>
    </div>
</template>

<script setup lang="ts"> 
  import { useContactForm, type ContactFormType } from '@/composables/useContactForm';

  const props = defineProps({
    initialValues: {
      type: Object as () => ContactFormType,
      required: false,
      default: () => ({
        contact_name: '',
        contact_phone: '',
        contact_email: '',
        address: '',
        number: '',
        neighborhood: '',
        city: '',
        state: '',
        postal_code: '',
      }),
    },
  });

  const { 
    formData, 
    handleSubmit, 
    isEditing, 
    submittedData, isSearchingCep, handleCepChange } = useContactForm(props.initialValues);
</script>