<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class is to be linked with the Ajax model class. 
 * It's purpose is to give the mapping of the Ajax model, 
 * just in order not to have a 2000+ lines model file.
 */
class AjaxMap extends CI_Model {
    private $map = array(
        'test' => array(
            'auth' => true,
            'cors' => array(
                'http://example.com:80',
                'https://example.com:80',
                'https://example.com:8000',
                'https://test.fr:80',
            ),
            'params' => array(
                'get' => array(
                    'mandatory' => array(
                        // 'param1',
                        // 'param2',
                    ),
                    'optional' => array(
                        // 'param3',
                        // 'param4',
                    )
                ),
                'post' => array(
                    'mandatory' => array(
                        // 'param1',
                        // 'param2',
                    ),
                    'optional' => array(
                        // 'param3',
                        // 'param4',
                    )
                )
            )
        ),
        'signin' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array(
                'post' => array(
                    'mandatory' => array(
                        'login',
                        'password',
                    ),
                )
            )
        ),
        'user' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array(
                'get' => array(
                    'mandatory' => array(
                        'user_id',
                    ),
                )
            )
        ),
        'book' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array(
                'get' => array(
                    'mandatory' => array(
                        'book_id',
                    ),
                )
            )
        ),
        'homeBooks' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array()
        ),
        'myBooks' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array()
        ),
        'bookInsert' => array(
            'auth' => true,
            'cors' => array(),
            'params' => array(
                'post' => array(
                    'mandatory' => array(
                        'title',
                    ),
                    'optional' => array(
                        'subtitle',
                        'description',
                        'image',
                    ),
                )
            )
        ),
        'bookEdit' => array(
            'auth' => true,
            'cors' => array(),
            'params' => array(
                'get' => array(
                    'mandatory' => array(),
                    'optional' => array(
                        'book_id',
                    ),
                ),
                'post' => array(
                    'mandatory' => array(),
                    'optional' => array(
                        'id',
                        'title',
                        'subtitle',
                        'description',
                        'image',
                    ),
                )
            )
        ),
        'search' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array(
                'post' => array(
                    'mandatory' => array(),
                    'optional' => array(
                        'generic',
                        'title',
                        'subtitle',
                        'author',
                    ),
                )
            )
        ),
        'bookContent' => array(
            'auth' => false,
            'cors' => array(),
            'params' => array(
                'get' => array(
                    'mandatory' => array(
                        'book_id',
                    ),
                )
            )
        ),

    );

    /**
     * Returns the good part of the mapping array
     * @return $array = array(
     *     'xxx' => array(
     *         'function' => 'X',
     *         'params' => array(
     *             'get' => array(
     *                 'mandatory' => array(
     *                     'param1',
     *                     'param2',
     *                 ),
     *                 'optional' => array(
     *                     'param3',
     *                     'param4',
     *                 )
     *             ),
     *             'post' => array(
     *                 'mandatory' => array(
     *                     'param1',
     *                     'param2',
     *                 ),
     *                 'optional' => array(
     *                     'param3',
     *                     'param4',
     *                 )
     *             )
     *         )
     *     )
     * );
     */
    public function getMap($key = '') {
        if (empty($key) || !isset($this->map[$key])) return false;
        else return $this->map[$key];
    }
}
