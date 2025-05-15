import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    once: true, // Animasi hanya jalan sekali
    duration: 1000, // Durasi default 1 detik
    easing: 'ease-in-out', // Animasi smooth
    delay: 200 // Delay awal sebelum animasi mulai
});

