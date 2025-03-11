<?php

return [
    /**
     * A map of which hours belong to which shift
     */
    'ops_shifts' => [
        // 0 -7
        'OWL', 'OWL', 'OWL', 'OWL', 'OWL', 'OWL', 'OWL',
        // 8 - 15
        'DAY', 'DAY', 'DAY', 'DAY', 'DAY', 'DAY', 'DAY', 'DAY',
        // 16 - 22
        'SWING', 'SWING', 'SWING', 'SWING', 'SWING', 'SWING', 'SWING', 'SWING',
        // 23
        'OWL',
    ],
    /**
     *  Options for display settings
     */
    'options' => [
        'entry_types' => ['ACCESS', 'AUTO', 'INFO', 'STAMP'],
    ],
    /**
     * Default Display settings
     */
    'display' => [
        'grouping' => 'Shift',
        'types' => ['ACCESS', 'AUTO', 'INFO', 'STAMP'],
    ],
    /**
     * Data for the sidebar Docs section
     */
    'sidebar_docs' => [
        'PSS Controlled Access Procedure' => 'https://jeffersonlab.sharepoint.com/sites/OpsDocs/Docs/PSS_controlled_access_proc.pdf',
        'PSS Elog Stamp User’s Guide' => 'https://jeffersonlab.sharepoint.com/sites/OpsDocs/Docs/PSS_Elog_stamp_user_guide.pdf',
        'PSS State Change Procedure' => 'https://jeffersonlab.sharepoint.com/sites/OpsDocs/Docs/PSS_state_change_proc.pdf',
        'PSS Sweep Procedure' => 'https://jeffersonlab.sharepoint.com/sites/OpsDocs/Docs/PSS_sweep_procedure.pdf',
    ],
    /**
     * Data for the sidebar Links section
     */
    'sidebar_links' => [
        'OPS Electronic Logbook' => 'https://logbooks.jlab.org/book/elog',
        'Qualified Sweepers Matrix' => 'https://accweb9.acc.jlab.org/apps/psslog/sweepers',
    ],

];
