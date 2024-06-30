import './bootstrap'; // Assuming this file contains your application initialization code

// Import jQuery
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

// Import Select2 (assuming you've already installed it via npm or yarn)
import 'select2';

// Initialize Select2 or any other jQuery plugins after the DOM is ready
$(document).ready(function() {
    // Initialize Select2
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        // Other Select2 options...
    });

    // Your other initialization code here...
});

// Export Vite configuration (if necessary)
export default {
    // Other Vite config options...
    optimizeDeps: {
        exclude: ['jquery'],
    },
};
