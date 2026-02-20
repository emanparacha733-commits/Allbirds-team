<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
  class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
>
  <!-- SIDEBAR HEADER -->
  <div
    :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="flex items-center gap-2 pt-8 sidebar-header pb-7"
  >
    <a href="index.html">
      <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
        <img class="dark:hidden" src="./images/logo/logo.svg" alt="Logo" />
        <img
          class="hidden dark:block"
          src="./images/logo/logo-dark.svg"
          alt="Logo"
        />
      </span>

      <img
        class="logo-icon"
        :class="sidebarToggle ? 'lg:block' : 'hidden'"
        src="./images/logo/logo-icon.svg"
        alt="Logo"
      />
    </a>
  </div>
  <!-- SIDEBAR HEADER -->

  <div
    class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
  >
    <!-- Sidebar Menu -->
    <nav x-data="{selected: $persist('Dashboard')}">
      <!-- Menu Group -->
      <div>
        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
          <span
            class="menu-group-title"
            :class="sidebarToggle ? 'lg:hidden' : ''"
          >
            MENU
          </span>

          <svg
            :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
            class="mx-auto fill-current menu-group-icon"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
              fill=""
            />
          </svg>
        </h3>

       <!-- Alpine Required -->
<script src="//unpkg.com/alpinejs" defer></script>

<aside class="w-[290px] h-screen bg-white border-r border-gray-200 p-5">

  <nav x-data="{ open: {{ request()->routeIs('admin.products.*') ? 'true' : 'false' }} }">

    <!-- Dashboard Button -->
    <button 
      @click="open = !open"
      class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-300"
      :class="open ? 'bg-black text-white' : 'hover:bg-gray-100 text-gray-700'"
    >
      <div class="flex items-center gap-3">
        <!-- Icon -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
          <path d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/>
        </svg>

        <span class="font-medium">Dashboard</span>
      </div>

      <!-- Arrow -->
      <svg class="w-4 h-4 transition-transform duration-300"
           :class="open ? 'rotate-180' : ''"
           fill="none"
           stroke="currentColor"
           stroke-width="2"
           viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M19 9l-7 7-7-7"/>
      </svg>
    </button>

    <!-- Dropdown -->
    <div x-show="open"
         x-transition:enter="transition-all ease-out duration-300"
         x-transition:enter-start="opacity-0 max-h-0"
         x-transition:enter-end="opacity-100 max-h-40"
         x-transition:leave="transition-all ease-in duration-200"
         x-transition:leave-start="opacity-100 max-h-40"
         x-transition:leave-end="opacity-0 max-h-0"
         class="overflow-hidden">

      <ul class="mt-2 space-y-1 pl-6">

        <!-- Add Product -->
        <li>
          <a href="{{ route('admin.products.create') }}"
             class="block px-4 py-2 rounded-lg text-sm transition-all duration-200
             {{ request()->routeIs('admin.products.create') ? 'bg-gray-200 font-semibold text-black' : 'text-gray-600 hover:bg-gray-100' }}">
            Add New Product
          </a>
        </li>

        <!-- Edit Products -->
        <li>
          <a href="{{ route('admin.products.index') }}"
             class="block px-4 py-2 rounded-lg text-sm transition-all duration-200
             {{ request()->routeIs('admin.products.index') ? 'bg-gray-200 font-semibold text-black' : 'text-gray-600 hover:bg-gray-100' }}">
            Edit Products
          </a>
        </li>

        <!-- View Product Detail -->
        <li>
          <a href="{{ route('admin.products.show', 1) }}"
             class="block px-4 py-2 rounded-lg text-sm transition-all duration-200
             {{ request()->routeIs('admin.products.show') ? 'bg-gray-200 font-semibold text-black' : 'text-gray-600 hover:bg-gray-100' }}">
            View Detail of Product
          </a>
        </li>

      </ul>
    </div>

  </nav>
</aside>



         </div>
</aside>
