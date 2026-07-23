<?php

namespace App\Services;

use App\Models\SuratRequest;

class SuratParserService
{
    /**
     * Parses the template body with the form data.
     * Replaces {{variable_name}} with the actual value from form_data.
     *
     * @param int $requestId
     * @return string
     */
    public function parseTemplate($requestId)
    {
        $suratRequest = SuratRequest::with('template')->findOrFail($requestId);
        
        $htmlBody = $suratRequest->template->body;
        $formData = $suratRequest->form_data;
        
        // If the user modified the HTML manually during request creation, return that
        if (!empty($formData['_custom_html'])) {
            return $formData['_custom_html'];
        }

        if (empty($htmlBody)) {
            return '';
        }
        
        if (empty($formData) || !is_array($formData)) {
            return $htmlBody;
        }

        // Replace placeholders {{nama_variabel}} with actual values
        foreach ($formData as $key => $value) {
            // Regex to match {{key}} or {{ key }}
            $pattern = '/\{\{\s*' . preg_quote($key, '/') . '\s*\}\}/i';
            
            // Check if value is a base64 image (signature)
            if (is_string($value) && strpos($value, 'data:image/') === 0) {
                // Render as image tag for signatures
                $replacement = '<img src="' . htmlspecialchars($value) . '" alt="Signature" style="max-height: 100px; display: inline-block; vertical-align: middle;">';
            } else {
                // Regular string or array replacement
                $replacement = is_array($value) ? json_encode($value) : htmlspecialchars((string) $value);
            }
            
            $htmlBody = preg_replace($pattern, $replacement, $htmlBody);
        }

        return $htmlBody;
    }
}
