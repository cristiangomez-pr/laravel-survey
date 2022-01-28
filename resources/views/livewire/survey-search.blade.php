<div>
    
    <div class="w-full">
        <div class="relative">
           <input wire:model="search" type="search" placeholder="Buscar..." class="text-gray-600 py-2 pr-4 pl-10 block w-full appearance-none leading-normal rounded-lg focus:outline-none text-left select-none truncate bg-white border border-gray-300 focus:ring-1 focus:border-blue-500">
           <div class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center">
              <svg class="fill-current pointer-events-none text-gray-600 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                 <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
              </svg>
           </div>
        </div>
    </div>

    <div 
        x-data="{
            clipboard(content) {  
                navigator.clipboard.writeText(content)
                .then(() => {
                    $dispatch('clipboard-1')
                })
                .catch(err => {
                    console.log('Something went wrong', err);
                });
            }
        }"
        class="mt-8 flex flex-col"
    >
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden border border-gray-200 sm:rounded-lg">
              <table class="min-w-full @unless($this->surveys->isEmpty()) divide-y divide-gray-200 @endunless">
                <thead class="bg-gray-50 @if($this->surveys->isEmpty()) hidden @endif"">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Encuesta
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Preguntas
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Respondido
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Ultima actualizacion
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($this->surveys as $survey)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-sky-700 hover:text-sky-600">
                            <a href="{{ route('survey.start', $survey['slug']) }}"  class="inline-flex items-center">
                                <span>{{ $survey['name'] }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                            {{ $survey['questions_count'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                            {{ $survey['entries_count'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                            {{ $survey['updated_at'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-normal">
                            <div class="inline-flex items-baseline space-x-2">
                                <div x-data="{ shown: false, timeout: null }"
                                    @clipboard-{{ $survey['id'] }}.window="() => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  }"
                                    x-show.transition.out.opacity.duration.1500ms="shown"
                                    x-transition:leave.opacity.duration.1500ms
                                    style="display: none;"
                                    class="inline-flex items-center text-sm text-gray-600"
                                >
                                    <div class="h-4 w-4 mx-1"></div>
                                    <span>Enlace copiado.</span>
                                </div>
                                    
                                <a @click="clipboard('{{ route('survey.start', $survey['slug']) }}', '{{ $survey['id'] }}')" class="cursor-pointer inline-flex items-center text-gray-400 hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                    <span>Copiar enlace</span>
                                </a>

                                <a href="{{ route('surveys.export', $survey['id']) }}" class="inline-flex items-center text-gray-400 hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Descargar respuestas</span>
                                </a>
                            </div>
                        </td>
                    </tr>        
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4">
                            <div class="flex flex-col justify-center">
                                <svg class="w-full h-64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" data-name="Layer 1" width="647.63626" height="632.17383" viewBox="0 0 647.63626 632.17383"><path d="M687.3279,276.08691H512.81813a15.01828,15.01828,0,0,0-15,15v387.85l-2,.61005-42.81006,13.11a8.00676,8.00676,0,0,1-9.98974-5.31L315.678,271.39691a8.00313,8.00313,0,0,1,5.31006-9.99l65.97022-20.2,191.25-58.54,65.96972-20.2a7.98927,7.98927,0,0,1,9.99024,5.3l32.5498,106.32Z" transform="translate(-276.18187 -133.91309)" fill="#f2f2f2"/><path d="M725.408,274.08691l-39.23-128.14a16.99368,16.99368,0,0,0-21.23-11.28l-92.75,28.39L380.95827,221.60693l-92.75,28.4a17.0152,17.0152,0,0,0-11.28028,21.23l134.08008,437.93a17.02661,17.02661,0,0,0,16.26026,12.03,16.78926,16.78926,0,0,0,4.96972-.75l63.58008-19.46,2-.62v-2.09l-2,.61-64.16992,19.65a15.01489,15.01489,0,0,1-18.73-9.95l-134.06983-437.94a14.97935,14.97935,0,0,1,9.94971-18.73l92.75-28.4,191.24024-58.54,92.75-28.4a15.15551,15.15551,0,0,1,4.40966-.66,15.01461,15.01461,0,0,1,14.32032,10.61l39.0498,127.56.62012,2h2.08008Z" transform="translate(-276.18187 -133.91309)" fill="#3f3d56"/><path d="M398.86279,261.73389a9.0157,9.0157,0,0,1-8.61133-6.3667l-12.88037-42.07178a8.99884,8.99884,0,0,1,5.9712-11.24023l175.939-53.86377a9.00867,9.00867,0,0,1,11.24072,5.9707l12.88037,42.07227a9.01029,9.01029,0,0,1-5.9707,11.24072L401.49219,261.33887A8.976,8.976,0,0,1,398.86279,261.73389Z" transform="translate(-276.18187 -133.91309)" fill="#536dfe"/><circle cx="190.15351" cy="24.95465" r="20" fill="#536dfe"/><circle cx="190.15351" cy="24.95465" r="12.66462" fill="#fff"/><path d="M878.81836,716.08691h-338a8.50981,8.50981,0,0,1-8.5-8.5v-405a8.50951,8.50951,0,0,1,8.5-8.5h338a8.50982,8.50982,0,0,1,8.5,8.5v405A8.51013,8.51013,0,0,1,878.81836,716.08691Z" transform="translate(-276.18187 -133.91309)" fill="#e6e6e6"/><path d="M723.31813,274.08691h-210.5a17.02411,17.02411,0,0,0-17,17v407.8l2-.61v-407.19a15.01828,15.01828,0,0,1,15-15H723.93825Zm183.5,0h-394a17.02411,17.02411,0,0,0-17,17v458a17.0241,17.0241,0,0,0,17,17h394a17.0241,17.0241,0,0,0,17-17v-458A17.02411,17.02411,0,0,0,906.81813,274.08691Zm15,475a15.01828,15.01828,0,0,1-15,15h-394a15.01828,15.01828,0,0,1-15-15v-458a15.01828,15.01828,0,0,1,15-15h394a15.01828,15.01828,0,0,1,15,15Z" transform="translate(-276.18187 -133.91309)" fill="#3f3d56"/><path d="M801.81836,318.08691h-184a9.01015,9.01015,0,0,1-9-9v-44a9.01016,9.01016,0,0,1,9-9h184a9.01016,9.01016,0,0,1,9,9v44A9.01015,9.01015,0,0,1,801.81836,318.08691Z" transform="translate(-276.18187 -133.91309)" fill="#536dfe"/><circle cx="433.63626" cy="105.17383" r="20" fill="#536dfe"/><circle cx="433.63626" cy="105.17383" r="12.18187" fill="#fff"/></svg>
                                <div class="w-full pt-4 pb-4 text-gray-600 text-center">No se encontro ninguna encuesta.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="pt-4">{{ $this->surveys->links() }}</div>
    </div>

</div>
