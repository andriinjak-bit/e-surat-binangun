<div class="mt-8 border-t pt-6">
    <div class="flex items-center justify-between mb-4">
        <h4 class="font-bold text-[#0B2E4F] flex items-center gap-2">
            <i class="fas fa-comments"></i> Diskusi
        </h4>
        <span class="text-sm text-gray-500">{{ $surat->comments->count() }} pesan</span>
    </div>

    <!-- Comments List -->
    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto" id="comment-list">
        @forelse($surat->comments as $comment)
            <div class="bg-{{ $comment->is_admin ? 'blue' : 'gray' }}-50 rounded-lg p-4 border border-{{ $comment->is_admin ? 'blue' : 'gray' }}-100">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full {{ $comment->is_admin ? 'bg-blue-500' : 'bg-gray-500' }} flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr($comment->user->name ?? 'U', 0, 2)) }}
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-bold text-sm">{{ $comment->user->name ?? 'Unknown' }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $comment->is_admin ? 'bg-blue-200 text-blue-800' : 'bg-gray-200 text-gray-700' }}">
                                {{ $comment->is_admin ? 'Admin' : 'Warga' }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->format('d M Y H:i') }}</span>
                            @if($comment->is_admin && $comment->user_id === Auth::id())
                                <span class="text-xs text-blue-500">(Anda)</span>
                            @endif
                        </div>
                        <p class="text-gray-700 mt-1 text-sm whitespace-pre-wrap">{{ $comment->message }}</p>
                        @if($comment->attachment_path)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $comment->attachment_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm">
                                    <i class="fas fa-paperclip"></i> Lihat Lampiran
                                </a>
                            </div>
                        @endif
                        @if(Auth::id() === $comment->user_id || Auth::user()->is_admin)
                            <div class="mt-2">
                                <form action="{{ route('comment.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-400 py-8">
                <i class="fas fa-comment-slash text-3xl mb-2 block"></i>
                <p>Belum ada diskusi. Kirim pesan pertama!</p>
            </div>
        @endforelse
    </div>

    <!-- Comment Form -->
    <div class="bg-white rounded-lg border p-4">
        <form action="{{ route('surat.comment.store', $surat) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Tulis Pesan</label>
                    <textarea name="message" rows="3" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis pesan Anda...">{{ old('message') }}</textarea>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex-1">
                        <input type="file" name="attachment" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="text-xs text-gray-400 mt-1">Maks 2MB (JPG, PNG, PDF, DOC, DOCX)</p>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-[#E8A317] text-[#061E33] rounded-lg hover:bg-[#F4C542] font-bold">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-scroll to bottom of comments
document.addEventListener('DOMContentLoaded', function() {
    const commentList = document.getElementById('comment-list');
    if (commentList) {
        commentList.scrollTop = commentList.scrollHeight;
    }
});

// Auto-refresh comments every 30 seconds
setInterval(function() {
    fetch(window.location.href)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newComments = doc.getElementById('comment-list');
            const currentComments = document.getElementById('comment-list');
            if (newComments && currentComments) {
                currentComments.innerHTML = newComments.innerHTML;
                currentComments.scrollTop = currentComments.scrollHeight;
            }
        })
        .catch(error => console.error('Error refreshing comments:', error));
}, 30000);
</script>