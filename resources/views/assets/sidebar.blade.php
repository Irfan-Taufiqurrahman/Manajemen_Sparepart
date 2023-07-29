@include('assets.head')

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform sm:translate-x-0 border-r border-gray-300 shadow-lg" :class="{ '-translate-x-full': !isSidebarOpen }" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
        <a href="https://flowbite.com/" class="flex items-center pl-2.5 mb-5 p-2 mb-10">
            <img src="img/logo_PT.png" class="h-6 mr-3 sm:h-7" />
            <span class="self-center text-xl font-semibold whitespace-nowrap text-gray-900">PT. Samudera Suri</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('maintenance.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 aria-hidden=" true xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Maintenance</span>
                </a>
            </li>
            <!--@php
            $userRole = auth()->user()->role->name;
            @endphp
            <p>User Role: {{ $userRole }}</p>
            <p>Admin Check: {{ auth()->user()->role->name === 'Admin' ? 'True' : 'False' }}</p>-->


            @if(auth()->user()->role->name === 'Admin')
            <li>
                <a href="{{ route('users.users') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->role->name === 'Admin')
            <li>
                <a href="{{ route('parts.parts') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M19.7 14.6c.1-.4.3-.9.3-1.4 0-2.1-1.7-3.8-3.8-3.8-.5 0-1 .1-1.4.3l-.8-1c.4-.6.6-1.3.6-2.1 0-2.2-1.8-4-4-4s-4 1.8-4 4c0 .8.3 1.5.6 2.1l-.8 1c-.4-.2-.9-.3-1.4-.3-2.1 0-3.8 1.7-3.8 3.8 0 .5.1 1 .3 1.4l-1.1 1.1c-.4-.2-.8-.3-1.2-.3-1.2 0-2.2 1-2.2 2.2s1 2.2 2.2 2.2c.5 0 1-.1 1.4-.3l1.1 1.1c-.1.4-.3.9-.3 1.4 0 2.1 1.7 3.8 3.8 3.8 1.1 0 2.1-.5 2.7-1.3l1.6 1.1c-.3.7-.5 1.5-.5 2.3 0 2.2 1.8 4 4 4s4-1.8 4-4c0-.8-.3-1.6-.5-2.3l1.6-1.1c.6.8 1.6 1.3 2.7 1.3 2.1 0 3.8-1.7 3.8-3.8 0-.5-.1-1-.3-1.4l1.1-1.1c.4.2.8.3 1.2.3 1.2 0 2.2-1 2.2-2.2s-1-2.3-2.2-2.3c-.5 0-1 .1-1.4.3L19.7 14.6zM12 15.5c-1.9 0-3.5-1.5-3.5-3.5s1.5-3.5 3.5-3.5 3.5 1.5 3.5 3.5-1.5 3.5-3.5 3.5z" />
                    </svg>;

                    <span class="flex-1 ml-3 whitespace-nowrap">Parts</span>
                </a>
            </li>
            @endif

            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 0a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1h-5a1 1 0 0 0-1-1H4a1 1 0 0 0-1-1zm-.293 2.293l-4 4V18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V3h-6a1 1 0 0 0-1-1H2.707zM11 3V1l4 4h-3a1 1 0 0 0-1-1z"></path>
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Report </span>
                </a>
            </li>

            <li>
                <a href="{{ route('kilometer.kilometer') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="currentColor" width="24" height="24">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path d="M343.3,292.9c-23.3,0-44.4,8.6-61,22.7c-5.2,4.1-12.3,3.1-16.4-2.1c-4.1-5.2-3.1-12.3,2.1-16.4
            c20.7-16.3,47.1-26.1,75.3-26.1c33.3,0,62.8,16.2,81.1,41.1c2.7,3.7,7.6,4.4,11.2,1.7c3.7-2.7,4.4-7.6,1.7-11.2
            C405.8,308.6,376.2,292.9,343.3,292.9z" />
                                <path d="M451.1,219.3c-3.9-2.1-8.8-1.2-12.1,1.9c-33.8,31.8-76.9,49.9-122.3,49.9c-53.4,0-101.2-27.4-128.9-69
            c-3.1-5.2-9.2-7.1-14.4-4c-5.2,3.1-7.1,9.2-4,14.4c32.3,54.3,91.3,90.6,157.4,90.6c53.6,0,102.2-25.9,133.3-66.5
            C459.2,227.3,455.1,221.4,451.1,219.3z" />
                                <path d="M256,0C114.8,0,0,114.8,0,256s114.8,256,256,256s256-114.8,256-256S397.2,0,256,0z M256,482.7c-126.2,0-229.3-103-229.3-229.3
            c0-126.2,103-229.3,229.3-229.3c126.2,0,229.3,103,229.3,229.3C485.3,379.7,382.2,482.7,256,482.7z" />
                            </g>
                        </g>
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Odo Kilometer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('service.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                        <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                        <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Part Butuh Service</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Overlay element (conditionally shown only on mobile view) -->
<div x-show="isSidebarOpen" x-on:click="isSidebarOpen = false" class="fixed inset-0 z-30 bg-black opacity-50 sm:hidden"></div>


<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.7.3/dist/alpine.min.js" defer></script>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        Alpine.data('sidebar', () => ({
            isSidebarOpen: true,
            closeSidebar() {
                this.isSidebarOpen = false;
            },
        }));
        // Add an event listener to close the sidebar when clicking outside
        document.addEventListener('click', (event) => {
            const sidebar = document.getElementById('logo-sidebar');
            if (sidebar && !sidebar.contains(event.target)) {
                window.Alpine?.dispatch('sidebar:close');
            }
        });
    });
</script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>