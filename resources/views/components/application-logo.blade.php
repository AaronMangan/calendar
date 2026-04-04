
<svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <!-- Dark glass gradient -->
    <linearGradient id="glassBg" x1="0" y1="0" x2="24" y2="24">
      <stop offset="0%" stop-color="#1f2937" stop-opacity="0.95"/>
      <stop offset="100%" stop-color="#111827" stop-opacity="0.9"/>
    </linearGradient>

    <!-- Subtle top reflection -->
    <linearGradient id="shine" x1="0" y1="0" x2="0" y2="10">
      <stop offset="0%" stop-color="#ffffff" stop-opacity="0.25"/>
      <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
    </linearGradient>

    <!-- Soft shadow -->
    <filter id="blur" x="-20%" y="-20%" width="140%" height="140%">
      <feGaussianBlur stdDeviation="1"/>
    </filter>
  </defs>

  <!-- Shadow -->
  <rect x="4" y="6" width="16" height="14" rx="2" fill="#000000" opacity="0.12" filter="url(#blur)"/>

  <!-- Glass body -->
  <rect x="3" y="5" width="18" height="16" rx="2"
        fill="url(#glassBg)"
        stroke="#374151"
        stroke-opacity="0.6"/>

  <!-- Top highlight -->
  <rect x="3" y="5" width="18" height="5" rx="2" fill="url(#shine)"/>

  <!-- Rings -->
  <rect x="7" y="3" width="2" height="4" rx="0.3" fill="#9ca3af"/>
  <rect x="15" y="3" width="2" height="4" rx="0.3" fill="#9ca3af"/>

  <!-- Grid squares -->
  <rect x="7" y="12" width="2" height="2" rx="0.2" fill="#e5e7eb"/>
  <rect x="11" y="12" width="2" height="2" rx="0.2" fill="#e5e7eb"/>
  <rect x="15" y="12" width="2" height="2" rx="0.2" fill="#e5e7eb"/>

  <rect x="7" y="16" width="2" height="2" rx="0.2" fill="#e5e7eb"/>
  <rect x="11" y="16" width="2" height="2" rx="0.2" fill="#e5e7eb"/>
  <rect x="15" y="16" width="2" height="2" rx="0.2" fill="#e5e7eb"/>
</svg>