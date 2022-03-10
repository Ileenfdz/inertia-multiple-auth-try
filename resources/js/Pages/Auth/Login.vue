<template>
    <Head title="Log in" />
    <div class="h-full align-middle bg-skye-500">
        <div class="flex justify-center my-4 bg-skye-500">
            <h2>
                <span class="">Iniciar sesión</span>/<Link
                    :href="route('register')"
                    >Registrarse</Link
                >
            </h2>
        </div>

        <div class="flex justify-center bg-skye-500">
            <div class="block max-w-sm p-6 bg-white rounded-lg shadow-lg">
                <jet-validation-errors class="mb-4" />

                <div
                    v-if="status"
                    class="mb-4 text-sm font-medium text-green-600"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <jet-label for="email" value="Email" />
                        <jet-input
                            id="email"
                            type="email"
                            class="block w-full mt-1"
                            v-model="form.email"
                            required
                            autofocus
                        />
                    </div>

                    <div class="mt-4">
                        <jet-label for="password" value="Password" />
                        <jet-input
                            id="password"
                            type="password"
                            class="block w-full mt-1"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <jet-checkbox
                                name="remember"
                                v-model:checked="form.remember"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Remember me</span
                            >
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-gray-600 underline hover:text-gray-900"
                        >
                            Forgot your password?
                        </Link>

                        <jet-button
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Head,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
                remember: false,
            }),
        };
    },

    methods: {
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    remember: this.form.remember ? "on" : "",
                }))
                .post(this.route("login"), {
                    onFinish: () => this.form.reset("password"),
                });
        },
    },
});
</script>
