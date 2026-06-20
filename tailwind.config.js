// Simpan file ini sebagai tailwind.config.js atau sesuaikan dengan konfigurasi tema framework Anda
module.exports = {
  theme: {
    extend: {
      colors: {
        ink: '#17191c',          // Teks utama, permukaan gelap, tombol utama
        'pure-white': '#ffffff', // Kanvas utama halaman, permukaan kartu
        fog: '#f7f7f8',          // Latar belakang seksi, kanvas sidebar
        ash: '#4c4c4c',          // Teks body sekunder
        graphite: '#777b86',     // Teks tersier, stroke ikon linear
        dove: '#a3a6af',         // Pembatas hairline (divider), text placeholder
        slate: '#8b8c8d',        // Border ikon low-emphasis
        obsidian: '#000000',     // Border tajam dengan weight sangat kecil
        rust: '#5d2a1a',         // Aksen hangat signature (data-viz, link penegas)
        'apricot-wash': '#fbe1d1', // Latar belakang widget hangat, glow efek hero
        'sky-wash': '#d3e3fc',     // Latar belakang widget dingin, chat, badge khusus
      },
      fontFamily: {
        // Font serif editorial khusus Headline & Hero Display (min 40px)
        signifier: ['Signifier', 'GT Sectra', 'Tiempos Headline', 'Source Serif Pro', 'serif'],
        // Font sans-serif fungsional untuk navigasi, body, tabel, dan form
        sohne: ['Sohne', 'Inter', 'General Sans', 'Untitled Sans', 'sans-serif'],
      },
      fontWeight: {
        regular: '400',
        w430: '430',  // Gradasi berat mikro khas Steep untuk hierarki data padat
        w450: '450',  
        w480: '480',  
        medium: '500',
      },
      boxShadow: {
        // Tiga lapis bayangan khas Steep: 1px ink-tint border + soft drop + micro drop
        subtle: 'rgba(4, 23, 43, 0.05) 0px 0px 0px 1px, rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.1) 0px 8px 10px -6px',
      },
      borderRadius: {
        tags: '9999px',
        cards: '24px',
        images: '12px',
        inputs: '16px',
        avatars: '9999px',
        buttons: '9999px',
      },
      spacing: {
        '4': '4px',
        '8': '8px',
        '12': '12px',
        '16': '16px',
        '20': '20px',
        '24': '24px',
        '28': '28px',
        '32': '32px',
        '40': '40px',
        '64': '64px',
        '80': '80px',
        '96': '96px',
        '124': '124px',
        '128': '128px',
        '160': '160px',
      }
    },
  },
}