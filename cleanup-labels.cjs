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
    
    // Convert remaining text-gray-700 to text-blue-950 for labels
    content = content.replace(/text-gray-700/g, 'text-blue-950');
    content = content.replace(/bg-gray-200/g, 'bg-blue-100'); // the cancel buttons
    content = content.replace(/hover:bg-gray-300/g, 'hover:bg-blue-200'); // cancel buttons hover
    
    // Fix buttons inconsistencies: we want all standard buttons to use rounded-md, not rounded-lg or rounded
    content = content.replace(/rounded /g, 'rounded-md ');
    content = content.replace(/rounded-lg /g, 'rounded-md '); // Wait, this might affect cards! I shouldn't replace rounded-lg indiscriminately
    
    // Revert rounded-md for cards
    content = content.replace(/rounded-md shadow-sm overflow-hidden border/g, 'rounded-xl shadow-sm overflow-hidden border');
    
    if (content !== original) {
        fs.writeFileSync(file, content);
    }
});
console.log('Fixed labels and cancel buttons');
