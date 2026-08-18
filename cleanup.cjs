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
    
    // Normalize container rounding and padding for tables
    content = content.replace(/rounded-lg shadow-sm overflow-x-auto/g, 'rounded-xl shadow-sm overflow-hidden');
    content = content.replace(/rounded-lg shadow-sm border/g, 'rounded-xl shadow-sm border');
    
    // Normalize table headers
    content = content.replace(/<th class="px-[0-9]+ py-[0-9]+ text-left text-xs font-(medium|semibold) (.*?) uppercase tracking-wider/g, '<th class="px-6 py-4 text-left text-xs font-bold $2 uppercase tracking-widest');
    content = content.replace(/<th class="px-[0-9]+ py-[0-9]+ text-right text-xs font-(medium|semibold) (.*?) uppercase tracking-wider/g, '<th class="px-6 py-4 text-right text-xs font-bold $2 uppercase tracking-widest');
    content = content.replace(/<th class="px-[0-9]+ py-[0-9]+ text-xs font-(medium|semibold) (.*?) uppercase tracking-wider/g, '<th class="px-6 py-4 text-left text-xs font-bold $2 uppercase tracking-widest');
    
    // If table header doesn't specify text-left but isn't right, make it text-left
    
    // Form buttons (e.g., 'bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700')
    // Standardize to rounded-md
    content = content.replace(/px-4 py-2 rounded /g, 'px-4 py-2 rounded-md ');
    
    // Td padding normalize to px-6 py-4
    // Make sure we aren't changing something incorrectly, so only specific td classes
    content = content.replace(/<td class="px-8 py-5/g, '<td class="px-6 py-4');
    content = content.replace(/<th class="px-8 py-5/g, '<th class="px-6 py-4');
    
    // Remove duplicate/unnecessary title wrappers like mb-4 flex justify-between
    content = content.replace(/<div class="mb-4 flex justify-between items-center">/g, '<div class="mb-6 flex justify-between items-center">');
    
    if (content !== original) {
        fs.writeFileSync(file, content);
    }
});
console.log('Cleaned up UI consistency');
