<button {{ $attributes->class(['bg-blue-500 px-5 py-2 rounded-full font-medium text-white transition',
'hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
])->merge(['type' => 'button']) }}>
    {{ $slot }}
</button>
