<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="container-fluid">
        <div class="flex justify-between h-16">
            <!-- Left side - Dashboard Title -->
            <div class="flex items-center ms-4">
                <h1 class="dashboard-title text-lg font-semibold text-gray-800 dark:text-gray-200">
                    Attendance Dashboard
                </h1>
            </div>

            <!-- Right side - User Menu and Date Controls -->
            <div class="flex items-center pe-4">
                <div class="flex items-center space-x-4">
                    <!-- Current Month Display -->
                   
                    
                    
                    
                    <!-- User Dropdown -->
                    <div class="relative ms-3" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center">
                                <i class="fas fa-user-circle me-2 text-gray-400"></i>
                                <span class="text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                                <svg class="ms-2 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" 
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    .btn-nav-month {
        @apply p-1.5 text-sm text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors;
    }
    .dashboard-title {
        @apply text-gray-800 dark:text-gray-200 text-lg font-semibold;
    }
</style>