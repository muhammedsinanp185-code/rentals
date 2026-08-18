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
    
    // Backgrounds - Dark (change black to slate-950 and #111111 to slate-900)
    content = content.replace(/dark:bg-black/g, 'dark:bg-slate-950');
    content = content.replace(/dark:bg-\[\#111111\]/g, 'dark:bg-slate-900');
    content = content.replace(/bg-black/g, 'bg-slate-950');
    content = content.replace(/bg-\[\#111111\]/g, 'bg-slate-900');
    
    // Text - Dark mode (change yellow to slate-white text)
    content = content.replace(/dark:text-yellow-400/g, 'dark:text-slate-100');
    content = content.replace(/dark:text-yellow-500/g, 'dark:text-slate-300');
    content = content.replace(/dark:text-yellow-600/g, 'dark:text-slate-400');
    content = content.replace(/dark:text-yellow-700/g, 'dark:text-slate-500');
    
    // Borders
    content = content.replace(/dark:border-yellow-900\/50/g, 'dark:border-slate-800');
    content = content.replace(/dark:border-yellow-900/g, 'dark:border-slate-800');
    
    // Divide (Tables)
    content = content.replace(/dark:divide-zinc-800/g, 'dark:divide-slate-800');
    
    // Other hovers
    content = content.replace(/dark:hover:bg-zinc-800/g, 'dark:hover:bg-slate-800');
    
    fs.writeFileSync(file, content);
});
console.log('Replaced dark mode themes to slate/charcoal');
