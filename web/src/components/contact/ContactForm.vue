<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
  <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
      Dados de Contato e Endereço
    </h2>

    <form class="space-y-5">
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
          />
        </div>
      </div>

      <!-- Endereço e Número -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
          <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
            Endereço
          </label>
          <input
            type="text"
            id="address"
            name="address"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Rua Exemplo"
          />
        </div>

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
          />
        </div>
      </div>

      <!-- Bairro e Cidade -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
          />
        </div>

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
          />
        </div>
      </div>

      <!-- Estado e CEP -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
            Estado
          </label>
          <input
            type="text"
            id="state"
            name="state"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="SP"
          />
        </div>

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
          />
        </div>
      </div>

      <!-- Botão -->
      <div>
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
        >
          Salvar Dados
        </button>
      </div>
    </form>
  </div>
</div>
</template>