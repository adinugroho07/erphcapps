<template>
    <Head title="Log in" />

    <section class="h-full gradient-form bg-gray-200 md:h-screen">
      <div class="container py-12 px-6 h-full">
        <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
          <div class="xl:w-10/12">
            <div class="block bg-white shadow-lg rounded-lg">
              <div class="lg:flex lg:flex-wrap g-0">
                <div class="lg:w-6/12 px-4 md:px-0">
                  <div class="md:p-12 md:mx-6">
                    <div class="text-center">
                      <img
                        class="mx-auto w-48"
                        src="image/logo.png"
                        alt="logo"
                      />
                      <h4 class="text-xl font-semibold mt-1 mb-12 pb-1">Welcome To BHRS</h4>
                    </div>
                    <form @submit.prevent="submit">
                      <p class="mb-4">Please login to your account</p>
                      <jet-validation-errors class="mb-4" />
                      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                      </div>
                      <div class="mb-4">
                        <input
                          type="email"
                          name="email"
                          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="exampleFormControlInput1"
                          v-model="form.email" required
                          placeholder="Email"
                        />
                      </div>
                      <div class="mb-4">
                        <input
                          type="password"
                          name="password"
                          class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          id="exampleFormControlInput1"
                          v-model="form.password" required
                          placeholder="Password"
                        />
                      </div>
                      <div class="text-center pt-1 mb-12 pb-1">
                        <button
                          class="inline-block px-6 py-2.5 font-medium text-white text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3"
                          type="submit"
                          data-mdb-ripple="true"
                          data-mdb-ripple-color="light"
                          style="
                          background: linear-gradient(to right, #8c9cf4, #7c8cf4, #7c84f4, #6875f5);"
                        >
                          Log in
                        </button>

                      </div>
                    </form>
                  </div>
                </div>
                <div
                  class="lg:w-6/12 flex items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none"
                  style="
                  background: linear-gradient(to right, #8c9cf4, #7c8cf4, #7c84f4, #6875f5);"
                >
                  <div class="text-white px-4 py-6 md:p-12 md:mx-6">
                    <h4 class="text-xl font-semibold mb-6 text-center">PT Bahtera Interior</h4>
                    <p class="text-sm text-center">
                      PT Bahtra Interior merupakan sebuah perusahaan konsultan yang memfokuskan diri sebagai konsultan dan kontraktor interior.
                      Didirikan pada tahun 2016, Bahtra Interior memiliki sejarah sepanjang lebih dari 5 tahun dalam bidang perencanaan
                      interior dan konstruksi interior untuk hunian, kantor, hotel, dan ruang komersial melalui desain yang disesuaikan dengan
                      calon pengguna ruang
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },


        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                }),
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
