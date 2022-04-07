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
          <div>
            <div class="md:grid md:grid-cols-2 md:gap-0">
              <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                  <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Profile
                  </h3>
                  <p class="mt-1 text-sm text-gray-600">
                    This information will be displayed publicly so be careful
                    what you share.
                  </p>
                </div>
              </div>
              <div class="mt-5 md:mt-0 md:col-span-1">
                <jet-validation-errors class="mb-4" />

                <form @submit.prevent="submit">
                  <div>
                    <jet-label for="name" value="Name" />
                    <jet-input
                      id="name"
                      v-model="form.name"
                      autocomplete="name"
                      autofocus
                      class="mt-1 block w-full"
                      required
                      type="text"
                    />
                  </div>

                  <div class="mt-4">
                    <jet-label for="email" value="Email" />
                    <jet-input
                      id="email"
                      v-model="form.email"
                      class="mt-1 block w-full"
                      required
                      type="email"
                    />
                  </div>

                  <Listbox v-model="selected" as="div" class="mt-4">
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

                  <div class="mt-4">
                    <jet-label for="department" value="Department" />
                    <jet-input
                      id="department"
                      v-model="form.department"
                      class="mt-1 block w-full"
                      required
                      type="text"
                    />
                  </div>

                  <div class="mt-4">
                    <jet-label for="posname" value="Position Name" />
                    <jet-input
                      id="posname"
                      v-model="form.posname"
                      class="mt-1 block w-full"
                      required
                      type="text"
                    />
                  </div>

                  <div class="mt-4">
                    <jet-label for="password" value="Password" />
                    <jet-input
                      id="password"
                      v-model="form.password"
                      autocomplete="new-password"
                      class="mt-1 block w-full"
                      required
                      type="password"
                    />
                  </div>

                  <div class="mt-4">
                    <jet-label
                      for="password_confirmation"
                      value="Confirm Password"
                    />
                    <jet-input
                      id="password_confirmation"
                      v-model="form.password_confirmation"
                      autocomplete="new-password"
                      class="mt-1 block w-full"
                      required
                      type="password"
                    />
                  </div>

                  <div class="flex items-center justify-end mt-4">
                    <jet-button
                      :class="{ 'opacity-25': form.processing }"
                      :disabled="form.processing"
                      class="bg-cyan-500 hover:bg-cyan-600 ml-4"
                    >
                      Submit
                    </jet-button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";

export default defineComponent({
  components: {
    AppLayout,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  props: ["userManager"],
  setup(props) {
    const form = useForm({
      name: "",
      email: "",
      department: "",
      posname: "",
      status: "active",
      suppervisor: "",
      suppervisor_id: 0,
      password: "",
      password_confirmation: "",
    });

    const managerUp = ref(props.userManager);
    const selected = ref(props.userManager[0]);
    const submit = () => {
      console.log(selected.value.name);
      form.suppervisor = selected.value.name;
      form.suppervisor_id = selected.value.id;
      form.post("/users", {
        onFinish: () =>
          this.form.reset(
            "name",
            "department",
            "posname",
            "password",
            "password_confirmation"
          ),
      });
    };

    return {
      form,
      selected,
      managerUp,
      submit,
    };
  },
});
</script>

<style scoped></style>
