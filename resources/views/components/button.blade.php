<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center inline-flex items-center px-4 py-2 bg-white-800 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-black-700 focus:bg-white-700 active:bg-white-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
