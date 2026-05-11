<x-web-layout>

  <section class="services-hero">
    <div class="hero-overlay"></div>
    <div
      class="relative flex w-full max-w-screen-xl justify-center mx-auto z-10 px-4 xl:px-12 pt-36 xl:pt-48 pb-16 xl:pb-12">
      <div class="w-full max-w-prose text-white text-center">
        <h1 class="font-display text-4xl font-bold xl:text-5xl xl:mb-4">{{ __('services.pageTitle') }}</h1>
      </div>
    </div>
  </section>

  <section class="section-services">
    <div class="w-full max-w-screen-xl mx-auto px-4 xl:px-12 py-12 xl:py-16">

      <div id="brokerage"
        class="flex flex-wrap lg:flex-nowrap gap-4 xl:gap-12 mb-8 xl:mb-12 pb-8 border-b border-gray-200">
        <div class="w-full lg:w-1/4">
          <div class="mb-2">
            <img class="w-16 h-auto"
              src="data:image/png;base64,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" />
          </div>
          <h2 class="font-display text-2xl font-bold uppercase text-blue xl:text-2xl xl:mb-4">Brokerage</h2>
        </div>
        <div class="w-full lg:w-3/4 text-base lg:text-xl">
          {!! __('services.brokerageText') !!}
        </div>
      </div>

      <div id="investment-management"
        class="flex flex-wrap lg:flex-nowrap gap-4 xl:gap-12 mb-8 xl:mb-12 pb-8 border-b border-gray-200">
        <div class="w-full lg:w-1/4">
          <div class="mb-2">
            <img class="w-16 h-auto"
              src="data:image/png;base64,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" />
          </div>
          <h2 class="font-display text-2xl font-bold uppercase text-blue xl:text-2xl xl:mb-4">Investment Management</h2>
        </div>
        <div class="w-full lg:w-3/4 text-base lg:text-xl">
          {!! __('services.investmentManagementText') !!}
        </div>
      </div>

      <div id="corporate-finance" class="hidden flex-wrap lg:flex-nowrap gap-4 xl:gap-12 mb-8 xl:mb-10">
        <div class="w-full lg:w-1/4">
          <div class="mb-2">
            <img class="w-16 h-auto"
              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAABmJLR0QA/wD/AP+gvaeTAAAC3klEQVR4nO3bsWsTYRjH8d+TJlFbcSgohtTF3dXJwak0ZlAKbi4i+C/oqGN3hwQKoptmaKNCB7fSgrt7URBb3IKKSEMeFw+KqLl73/fe583l99nUxnt5vtxd7uUKEBEREREREREREc0DiXmwW5/1DoBNAKccPv4JgvvbLdkJvCxTtZgHE8EC3IYPACtQ9EOuJwVRA2y15JkqHnr8F5eCLSYRUQMAwLAtG54RKiV6AIARTjIJADBCxiwAAPxYwBMAB5ZrsGYWYPVIlxYneAPgstUaUlC3OOjtL3r2eIwdANcsjp+S6GfA6pEuHY/xGhw+gMhnwInLzvWYx/WxfqhdVfQVaBf8aK4n92hnQKHhKz6Wv6J8Joqew/CBnE/uUQIUGb4C+5MmriT0FXXF47NTn9xLD1B0+NpA59V5+TovzwmlBnAdfvZ38xChtAC+w88M27IBxePff/wZep3WSvkWFGr4me22PLp5qAdQjIMuNAHBA4QefmbYkudBFpiYoJegsoZfZcECcPhuggTg8N15B+Dw/XjdhGdh+Fd3R11V7QPisp1QOucAszB8AFCVHtz2cqJwvgQtTvAU+XY195p1rNlddtRnL6d0PveATo6f2WvU0RlckG8ex6k05wACvJ3yIxx+Ds4B6qdxVxXv/vZvCuxPGrjB4U/nHGCwLKPmGaz9GYFfNYvxeg7IIgiwBeA7BC9sb7izx3szbrAsIwDrAdYyl0xfzCIGMMcAxkzejCvi4uaHrmitj4S3E3wkfwaI1pLey/GVfAD4vZeTvFkIUGkMYIwBjDGAMQYwxgDGGMAYAxhjAGPl7wU9eN+F1PqAVnY7wUf5Z4BIj8P/txiXoErv5fjiPcAYAxhjAGMMYIwBjDGAMQYwxgDGGMDY1L2gc/dedlXF+b0cvqX7f1PPgNR/x2rW5bkEcS+nRLwHGGMAYwxgjAGMMYAxBjDGAMYYwBgDEBERERERERERRfILPLMCrdWWGygAAAAASUVORK5CYII=" />
          </div>
          <h2 class="font-display text-2xl font-bold uppercase text-blue xl:text-2xl xl:mb-4">Corporate Finance</h2>
        </div>
        <div class="w-full lg:w-3/4 text-base lg:text-xl">
          {!! __('services.investmentCorporateFinanceText') !!}
        </div>
      </div>

    </div>
  </section>

</x-web-layout>
