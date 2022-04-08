<script context="module">
  import Layout, { title } from '@/Shared/Layout.svelte'
  import Dropdown, {} from '@/Shared/Dropdown.svelte'
  export const layout = Layout
</script>

<script>
  import {useForm} from "@inertiajs/inertia-svelte";
  import {character} from "../Reports/Index.svelte";

  $title = 'Reports'

  let form = useForm(`character:${character.id}`, {
    name: organization.name,
    email: organization.email,
    phone: organization.phone,
    address: organization.address,
    city: organization.city,
    region: organization.region,
    country: organization.country,
    postal_code: organization.postal_code,
  })

</script>

<div>
  <h1 class="mb-8 font-bold text-3xl">Reports</h1>

  <form on:submit|preventDefault={update}>
    <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
      <TextInput
        bind:value={$form.name}
        error={$form.errors.name}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Name:" />
      <TextInput
        bind:value={$form.email}
        error={$form.errors.email}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Email:" />
      <TextInput
        bind:value={$form.phone}
        error={$form.errors.phone}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Phone:" />
      <TextInput
        bind:value={$form.address}
        error={$form.errors.address}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Address:" />
      <TextInput
        bind:value={$form.city}
        error={$form.errors.city}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="City:" />
      <TextInput
        bind:value={$form.region}
        error={$form.errors.region}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Province/State:" />
      <SelectInput
        bind:value={$form.country}
        error={$form.errors.country}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Country:"
        let:selected>
        <option value={null} />
        <option value="CA" selected={selected === 'CA'}>Canada</option>
        <option value="US" selected={selected === 'US'}>United States</option>
      </SelectInput>
      <TextInput
        bind:value={$form.postal_code}
        error={$form.errors.postal_code}
        class="pr-6 pb-8 w-full lg:w-1/2"
        label="Postal code:" />
    </div>
    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
      {#if !organization.deleted_at}
        <button class="text-red-600 hover:underline" tabindex="-1" type="button" on:click={destroy}>
          Delete Organization
        </button>
      {/if}

      <LoadingButton loading={$form.processing} class="btn-indigo ml-auto" type="submit">
        Update Organization
      </LoadingButton>
    </div>
  </form>
</div>
