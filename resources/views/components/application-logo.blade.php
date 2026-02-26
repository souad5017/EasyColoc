<svg viewBox="0 0 360 400" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>

    <!-- Gradient -->
    <defs>
        <linearGradient id="gradEC3" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#7C3AED"/>
            <stop offset="100%" stop-color="#4F46E5"/>
        </linearGradient>
    </defs>

    <!-- Roof -->
    <path d="M90 150 L180 50 L270 150"
          stroke="url(#gradEC3)"
          stroke-width="18"
          stroke-linecap="round"
          fill="none"/>

    <!-- Members (dots) -->
    <circle cx="120" cy="180" r="18" fill="url(#gradEC3)"/>
    <circle cx="180" cy="180" r="18" fill="url(#gradEC3)"/>
    <circle cx="240" cy="180" r="18" fill="url(#gradEC3)"/>

    <!-- Split line -->
    <line x1="180" y1="210" x2="180" y2="270"
          stroke="url(#gradEC3)"
          stroke-width="8"
          stroke-linecap="round"/>

</svg>