<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Users Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submitted="updateProfileInformation">
            <template #title>
              Profile Information
            </template>

            <template #description>
              Update your account's profile information and email address.
            </template>

            <template #form>

              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>

              <!-- Email -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
              </div>

              <!-- Supervisor -->
              <div class="col-span-6 sm:col-span-4">
              <Listbox v-model="selected" as="div" >
                <ListboxLabel
                  class="block text-sm font-medium text-gray-700"
                >
                  Assigned to
                </ListboxLabel>
                <div class="mt-1 relative">
                  <ListboxButton
                    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  >
                        <span class="flex items-center">
                          <img
                            :src="selected.profile_photo_url"
                            alt=""
                            class="flex-shrink-0 h-6 w-6 rounded-full"
                          />
                          <span class="ml-3 block truncate">
                            {{ selected.name }}
                          </span>
                        </span>
                    <span
                      class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                    >
                          <SelectorIcon
                            aria-hidden="true"
                            class="h-5 w-5 text-gray-400"
                          />
                        </span>
                  </ListboxButton>

                  <transition
                    leave-active-class="transition ease-in duration-100"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                  >
                    <ListboxOptions
                      class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                    >
                      <ListboxOption
                        v-for="person in managerUp"
                        :key="person.id"
                        v-slot="{ active, selected }"
                        :value="person"
                        as="template"
                      >
                        <li
                          :class="[
                                active
                                  ? 'text-white bg-indigo-600'
                                  : 'text-gray-900',
                                'cursor-default select-none relative py-2 pl-3 pr-9',
                              ]"
                        >
                          <div class="flex items-center">
                            <img
                              :src="person.profile_photo_url"
                              alt=""
                              class="flex-shrink-0 h-6 w-6 rounded-full"
                            />
                            <span
                              :class="[
                                    selected ? 'font-semibold' : 'font-normal',
                                    'ml-3 block truncate',
                                  ]"
                            >
                                  {{ person.name }}
                                </span>
                          </div>

                          <span
                            v-if="selected"
                            :class="[
                                  active ? 'text-white' : 'text-indigo-600',
                                  'absolute inset-y-0 right-0 flex items-center pr-4',
                                ]"
                          >
                                <CheckIcon aria-hidden="true" class="h-5 w-5" />
                              </span>
                        </li>
                      </ListboxOption>
                    </ListboxOptions>
                  </transition>
                </div>
              </Listbox>
              </div>
              <!-- Supervisor end -->

              <!-- Department -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="department" value="Department" />
                <jet-input id="department" type="text" class="mt-1 block w-full" v-model="form.department" />
                <jet-input-error :message="form.errors.department" class="mt-2" />
              </div>

              <!-- Posname -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="posname" value="Position Name" />
                <jet-input id="posname" type="text" class="mt-1 block w-full" v-model="form.posname" />
                <jet-input-error :message="form.errors.posname" class="mt-2" />
              </div>

              <!-- Status -->
              <div class="col-span-6 sm:col-span-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" v-model="form.status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="option in options" :selected="form.status === option.value" :key="option.value" :value="option.value">{{option.text}}</option>
                </select>
                <jet-input-error :message="form.errors.status" class="mt-2" />
              </div>
            </template>

            <template #actions>
              <Link href="/users" class="float-left">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600" >Back</jet-button>
              </Link>
              <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
              </jet-action-message>

              <jet-button class="bg-cyan-500 hover:bg-cyan-600" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
              </jet-button>
            </template>
          </jet-form-section>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import {defineComponent, ref} from 'vue'
import { useForm, Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import {CheckIcon, SelectorIcon} from "@heroicons/vue/solid";

export default defineComponent({
  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
    Link
  },
  props: ['user','userManager'],
  setup(props){
    const form = useForm({
      name: props.user.name,
      email: props.user.email,
      department: props.user.department,
      posname: props.user.posname,
      status: props.user.status,
      suppervisor: props.user.suppervisor,
      suppervisor_id: props.user.suppervisor_id,
    });

    const managerUp = ref(props.userManager);
    const selected = ref(props.userManager.find(u => u.id === props.user.suppervisor_id));

    const options = ref([
      { text: 'Active', value: 'active' },
      { text: 'Non Active', value: 'nonactive' },
    ]);

    const updateProfileInformation = () => {
      form.suppervisor = selected.value.name;
      form.suppervisor_id = selected.value.id;
      form.put('/users/'+props.user.id, {
        preserveScroll: true
      })
    };

    return {
      form,
      selected,
      managerUp,
      options,
      updateProfileInformation
    }
  }

});
</script>

<style scoped>

</style>
