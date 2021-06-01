<template>
  <div id="app" class="min-h-screen">
    <!-- Page Content -->
    <main>
      <div class="bg-gray-50 py-32 min-h-screen md:px-4 lg:px-6">
        <div class="max-w-5xl mx-auto">
          <h1
            class="text-center text-4xl font-display font-bold text-blue mb-4"
          >
            {{ __("Form Pembukaan Rekening") }}
          </h1>
          <div class="open-account flex flex-col flex-wrap">
            <ValidationObserver ref="form" v-slot="{ invalid }">
              <FormHeader />
              <StepFirst />
              <StepSecond />
              <StepThird />
              <StepFourth />
              <StepFinish />
              <FormButtons :invalid="invalid" />
            </ValidationObserver>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
<script>
import { ValidationObserver } from "vee-validate";
import FormHeader from "./OpenAccount/FormHeader.vue";
import StepFirst from "./OpenAccount/StepFirst.vue";
import StepSecond from "./OpenAccount/StepSecond.vue";
import StepThird from "./OpenAccount/StepThird.vue";
import StepFourth from "./OpenAccount/StepFourth.vue";
import StepFinish from "./OpenAccount/StepFinish.vue";
import FormButtons from "./OpenAccount/FormButtons.vue";
export default {
  components: {
    ValidationObserver,
    FormHeader,
    StepFirst,
    StepSecond,
    StepThird,
    StepFourth,
    StepFinish,
    FormButtons,
  },
};
</script>