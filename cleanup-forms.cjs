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
    let original = content;
    
    // Normalize table dividers
    content = content.replace(/divide-gray-200/g, 'divide-blue-50');
    content = content.replace(/divide-gray-50/g, 'divide-blue-50');
    content = content.replace(/dark:divide-gray-700/g, 'dark:divide-slate-800');
    content = content.replace(/dark:divide-zinc-800/g, 'dark:divide-slate-800');
    
    // Normalize table row hovers
    content = content.replace(/hover:bg-gray-50\/50/g, 'hover:bg-blue-50/50');
    content = content.replace(/hover:bg-white\/50/g, 'hover:bg-blue-50/50');
    content = content.replace(/hover:bg-white /g, 'hover:bg-blue-50/50 ');
    content = content.replace(/dark:hover:bg-gray-700\/50/g, 'dark:hover:bg-slate-800/50');
    content = content.replace(/dark:hover:bg-zinc-800\/50/g, 'dark:hover:bg-slate-800/50');
    
    // Some lines have `hover:bg-white dark:hover:bg-gray-700/50` -> `hover:bg-blue-50/50 dark:hover:bg-slate-800/50 transition-colors`
    content = content.replace(/hover:bg-blue-50\/50 dark:hover:bg-slate-800\/50"/g, 'hover:bg-blue-50/50 dark:hover:bg-slate-800/50 transition-colors"');
    
    // Fix `hover:bg-white dark:hover:bg-slate-800/50`
    content = content.replace(/hover:bg-white dark:hover:bg-slate-800\/50/g, 'hover:bg-blue-50/50 dark:hover:bg-slate-800/50 transition-colors');
    
    // Ensure all tables have transition-colors on hover
    content = content.replace(/class="hover:bg-blue-50\/50 dark:hover:bg-slate-800\/50"/g, 'class="hover:bg-blue-50/50 dark:hover:bg-slate-800/50 transition-colors"');

    // Forms: Normalize text inputs
    content = content.replace(/class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white"/g, 
                              'class="w-full rounded-md border-blue-200 dark:border-slate-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:text-slate-100 transition-colors"');
                              
    content = content.replace(/class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/g, 
                              'class="w-full rounded-md border-blue-200 dark:border-slate-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:text-slate-100 transition-colors"');
    
    // More basic forms fields
    content = content.replace(/border-gray-300/g, 'border-blue-200');
    content = content.replace(/focus:border-indigo-500/g, 'focus:border-blue-500');
    content = content.replace(/focus:ring-indigo-500/g, 'focus:ring-blue-500');
    content = content.replace(/dark:border-gray-700/g, 'dark:border-slate-700');
    content = content.replace(/dark:bg-gray-900/g, 'dark:bg-slate-900');
    
    // Ensure labels are consistent
    content = content.replace(/class="block font-medium text-sm text-gray-700 dark:text-gray-300"/g, 'class="block font-medium text-sm text-blue-950 dark:text-slate-300"');
    
    if (content !== original) {
        fs.writeFileSync(file, content);
    }
});
console.log('Cleaned up tables and forms consistency');
