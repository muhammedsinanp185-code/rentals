const fs = require('fs');
const path = require('path');

function walk(dir) {
    let results = [];
    const list = fs.readdirSync(dir);
    list.forEach(file => {
        file = path.join(dir, file);
        const stat = fs.statSync(file);
        if (stat && stat.isDirectory()) {
            results = results.concat(walk(file));
        } else {
            if (file.endsWith('.blade.php')) {
                results.push(file);
            }
        }
    });
    return results;
}

const files = walk('resources/views');

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    
    // Fix layout edge issue in customer and admin layouts
    if (file.includes('layouts') && (file.includes('customer.blade.php') || file.includes('admin.blade.php'))) {
        content = content.replace(/@yield\('content'\)/g, '<div class="max-w-7xl mx-auto">\n                    @yield(\'content\')\n                </div>');
    }
    
    // Backgrounds - Dark
    content = content.replace(/bg-zinc-950/g, 'bg-black');
    content = content.replace(/bg-zinc-900/g, 'bg-[#111111]');
    content = content.replace(/bg-gray-900/g, 'bg-black');
    content = content.replace(/bg-gray-800/g, 'bg-[#111111]');
    
    // Backgrounds - Light (remove zinc/gray backgrounds and replace with blueish ones if needed, or just white)
    content = content.replace(/bg-zinc-100/g, 'bg-blue-50');
    content = content.replace(/bg-gray-50/g, 'bg-white');
    content = content.replace(/bg-gray-100/g, 'bg-blue-50');
    
    // Text - Light mode
    content = content.replace(/text-gray-900/g, 'text-blue-950');
    content = content.replace(/text-zinc-900/g, 'text-blue-950');
    content = content.replace(/text-gray-800/g, 'text-blue-900');
    content = content.replace(/text-gray-600/g, 'text-blue-800');
    content = content.replace(/text-gray-500/g, 'text-blue-600');
    content = content.replace(/text-gray-400/g, 'text-blue-500');
    
    // Text - Dark mode (Yellow)
    content = content.replace(/dark:text-white/g, 'dark:text-yellow-400');
    content = content.replace(/dark:text-gray-100/g, 'dark:text-yellow-400');
    content = content.replace(/dark:text-gray-300/g, 'dark:text-yellow-500');
    content = content.replace(/dark:text-gray-400/g, 'dark:text-yellow-600');
    content = content.replace(/dark:text-gray-500/g, 'dark:text-yellow-700');
    
    // Borders
    content = content.replace(/dark:border-zinc-800/g, 'dark:border-yellow-900/50');
    content = content.replace(/dark:border-gray-700/g, 'dark:border-yellow-900/50');
    content = content.replace(/dark:border-gray-800/g, 'dark:border-yellow-900/50');
    content = content.replace(/border-gray-100/g, 'border-blue-100');
    content = content.replace(/border-gray-200/g, 'border-blue-200');
    
    fs.writeFileSync(file, content);
});
console.log('Replaced themes');
