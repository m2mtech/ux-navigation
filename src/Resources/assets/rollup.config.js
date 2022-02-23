/*
 * This file is part of the ux-navigation package.
 *
 * (c) 2022 m2m server software gmbh <tech@m2m.at>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import resolve from '@rollup/plugin-node-resolve';
import typescript from '@rollup/plugin-typescript';
import glob from 'glob';
import path from 'path';

const files = glob.sync('src/*controller.ts');
const packages = files.map((file) => {
    const absolutePath = path.join(__dirname, file);
    const packageData = require('./package.json');
    const peerDependencies = [...(packageData.peerDependencies ? Object.keys(packageData.peerDependencies) : [])];

    return {
        input: file,
        output: {
            file: path.join(absolutePath, '..', '..', 'dist', path.basename(file, '.ts') + '.js'),
            format: 'esm',
        },
        external: peerDependencies,
        plugins: [resolve(), typescript()],
    };
});

export default packages;
