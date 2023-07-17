<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                <li class="flex items-center xl:hidden">
                    <a href="javascript:;" class="block p-0 text-sm text-black transition-all ease-nav-brand" sidenav-trigger>
                        <div class="w-6 overflow-hidden">
                            <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-black transition-all"></i>
                            <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-black transition-all"></i>
                            <i class="ease relative block h-0.5 rounded-sm bg-black transition-all"></i>
                        </div>
                    </a>
                </li>

                <li class="text-sm leading-normal pl-7">
                    <a class="text-gray-800 opacity-50" href="javascript:;">Pages</a>
                </li>
                <li class="text-sm pl-2 capitalize leading-normal text-gray-800 before:float-left before:pr-2 before:text-gray-800 before:content-['/']" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="mb-0 font-bold text-gray-800 capitalize hidden sm:inline pl-7">Dashboard</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <div class="flex items-center md:ml-auto md:pr-4 hidden sm:inline">
            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                <!-- online builder btn  -->
                <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->

                <li class="relative flex items-center pr-2 pl-4">
                    <p class="hidden transform-dropdown-show"></p>
                    <a href="javascript:;" class="block p-0 text-sm text-gray-800 transition-all ease-nav-brand" dropdown-trigger aria-expanded="false">
                        <i class="cursor-pointer fa fa-user"></i>
                        <span class="ml-2">{{ Auth::user()->name }}</span>

                    </a>

                    <ul dropdown-menu class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border border-solid border-gray-300 shadow-lg bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">

                        <!-- add show class on dropdown open js -->
                        <li class="relative mb-2">
                            <a class="ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-white px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors" href="javascript:;">
                                <div class="flex py-1">

                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-1 text-sm font-normal leading-normal"><span class="font-semibold">Edit Akun </span></h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">
                                            <i class="mr-1 fa fa-clock"></i>
                                            {{ Auth::user()->role->name }}

                                        </p>
                                    </div>
                                </div>

                            </a>
                        </li>
                        <li class="relative mb-2">
                            <a class="ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-white px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors" href="{{ route('user.logout') }}">
                                <div class="flex py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-1 text-sm font-normal leading-normal"><span class="font-semibold">Logout </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>