<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <x-primary-button tag="a" href="{{route('koperasi.pengguna.anggota.create')}}">New Anggota</x-primary-button>
                    <br>

                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                          <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                  <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">E-mail</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Action</th>

                                  </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @php $num=1; @endphp
                                    @foreach($users as $user)
                                  <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $num++ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <x-primary-button tag="a" href="{{ route('koperasi.pengguna.anggota.edit', ['id' => $user->id]) }}"> Edit </x-primary-button>
                                        <x-danger-button
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('koperasi.pengguna.anggota.destroy', $user->id) }}')"
                                        >{{ __('Delete') }}</x-danger-button>
                                      </td>
                                @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                        <!-- MODAL -->
                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" x-bind:action="action" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Apakah anda yakin akan menghapus data?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Setelah proses dilakukan, maka data tidak dapat dikembalikan.') }}
                                </p>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Delete Data') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                      <!-- End OF Content -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>