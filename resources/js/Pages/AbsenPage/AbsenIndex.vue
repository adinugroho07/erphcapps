<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Absen Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submitabsen()">
            <template #title>
              Profile Information
            </template>

            <template #description>
              Update your account's profile information and email address.
            </template>


            <template #form>

              <jet-input id="userid" type="hidden" v-model="form.user_id"/>

              <!-- Entered At -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="enteredat" value="Entered At" />
                <jet-input id="enteredat" type="text" class="mt-1 block w-full" v-model="form.created_at" disabled/>
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>
              <!-- Entered At -->

              <!-- Name -->
              <div class="col-span-6 sm:col-span-3">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" disabled/>
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>
              <!-- Name -->

              <!-- Email -->
              <div class="col-span-6 sm:col-span-3">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" disabled/>
                <jet-input-error :message="form.errors.email" class="mt-2" />
              </div>
              <!-- Email -->

              <!-- Department -->
              <div class="col-span-6 sm:col-span-3">
                <jet-label for="department" value="Department" />
                <jet-input id="department" type="text" class="mt-1 block w-full" v-model="form.department" disabled/>
                <jet-input-error :message="form.errors.department" class="mt-2" />
              </div>
              <!-- Department -->

              <!-- Posname -->
              <div class="col-span-6 sm:col-span-3">
                <jet-label for="posname" value="Position Name" />
                <jet-input id="posname" type="text" class="mt-1 block w-full" v-model="form.posname" disabled/>
                <jet-input-error :message="form.errors.posname" class="mt-2" />
              </div>
              <!-- Posname -->

              <!-- Absen Type -->
              <div class="col-span-6 sm:col-span-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" v-model="form.absentype" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="option in options" :key="option.value" :value="option.value">{{option.text}}</option>
                </select>
                <jet-input-error :message="form.errors.absentype" class="mt-2" />
              </div>
              <!-- Absen Type -->

              <!-- Activity -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="activiy" value="Daily Activities" />
                <textarea id="activiy" placeholder="meeting with someone" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" v-model="form.activity"></textarea>
                <jet-input-error :message="form.errors.activity" class="mt-2" />
              </div>
              <!-- Activity -->
            </template>

            <template #actions>
              <Link href="/dashboard" class="">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600 mr-2" >Back</jet-button>
              </Link>

              <jet-button class="bg-cyan-500 hover:bg-cyan-600 object-left" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
              </jet-button>
            </template>
          </jet-form-section>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import {defineComponent} from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'

export default defineComponent( {
  components:{
    AppLayout,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetActionMessage,
    JetButton,
    Link
  },
  props:['created_at'],
  data(){
    return{
      form: this.$inertia.form({
        user_id: this.$page.props.user.id,
        created_at: this.created_at,
        name: this.$page.props.user.name,
        email: this.$page.props.user.email,
        department: this.$page.props.user.department,
        posname: this.$page.props.user.posname,
        activity: "",
        absenvalue:'',
        absentype: 'invalid',
      }),
      options: [
        { text: 'Please Chose One', value: 'invalid' },
        { text: 'Work From Office', value: 'wfo' },
        { text: 'Work From Home', value: 'wfh' },
        { text: 'Libur Tanggal Merah', value: 'libur' },
        { text: 'Cuti Pegawai Tahunan', value: 'cuti' },
      ],

    }
  },
  methods:{
    notif(title,description,type){
      createToast(
        {
          title: title,
          description: description
        },
        {
          showIcon: 'true',
          hideProgressBar: 'false',
          transition: 'slide',
          type: type,
        }
      )
    },
    submitabsen(){
      this.form.absenvalue = this.fillAbsenValue(this.form.absentype);
      console.log(this.form);
      this.form.post('/absen/absenrsc', {
        preserveScroll: false,
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message,'success');
          this.form.reset('activity')
          this.form.absentype = 'invalid'
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      });
    },
    fillAbsenValue(value){
      let returnme = '';
      if(value === 'wfo'){
        returnme = 'Work From Office';
      } else if(value === 'wfh'){
        returnme = 'Work From Home';
      } else if(value === 'libur'){
        returnme = 'Libur Tanggal Merah';
      } else if(value === 'cuti'){
        returnme = 'Cuti Pegawai Tahunan';
      } else {
        returnme = 'invalid';
      }
      return returnme;
    }
  }
});
</script>

